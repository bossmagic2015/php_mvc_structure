<?php

// กำหนดชื่อ namespace
namespace App\Core;

class View
{
    protected static array $stacks = [];
    protected static ?string $pushing = null;

    // function สำหรับเพิ่ม style หรือ script ที่ไฟล์นั้น ๆ
    public static function startPush(string $name): void
    {
        self::$pushing = $name;
        ob_start();
    }

    // function สำหรับสิ้นสุดบรรทัดที่ต้องการเพิ่ม style หรือ script ที่ไฟล์นั้น ๆ
    public static function endPush(): void
    {
        if (self::$pushing === null) {
            throw new \RuntimeException("endPush() called without startPush()");
        }
        self::$stacks[self::$pushing][] = ob_get_clean();
        self::$pushing = null;
    }

    // push string ตรง ๆ (ใช้กับ tag อะไรก็ได้)
    public static function push(string $name, string $content): void
    {
        self::$stacks[$name][] = $content;
    }

    // push <link> css จากไฟล์
    public static function pushCss(string $href, array $attrs = []): void
    {
        $attrsStr = self::attrs(array_merge([
            'rel' => 'stylesheet',
            'href' => $href,
        ], $attrs));

        self::push('styles', "<link{$attrsStr}>");
    }

    // push <script> js จากไฟล์
    public static function pushJs(string $src, array $attrs = []): void
    {
        $attrsStr = self::attrs(array_merge([
            'src' => $src,
        ], $attrs));

        self::push('scripts', "<script{$attrsStr}></script>");
    }

    // function สำหรับเรียกใช้ ไฟล์ style หรือ script ให้เปลี่ยนไปตามไฟล์ที่ต้องการ
    public static function stack(string $name): void
    {
        echo implode("\n", self::$stacks[$name] ?? []);
    }

    protected static function attrs(array $attrs): string
    {
        $out = '';
        foreach ($attrs as $k => $v) {
            $k = htmlspecialchars((string)$k, ENT_QUOTES, 'UTF-8');
            $v = htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
            $out .= " {$k}=\"{$v}\"";
        }
        return $out;
    }

    // function สำหรับเพิ่มส่วนของเนื้อหาต่าง ๆ ในไฟล์
    public static function render(string $view, array $data = [], string|null $layout = 'main'): void
    {
        self::$stacks = [];

        $viewFile = __DIR__ . '/../Views/' . $view . '.php'; // กำหนด path ให้ตรง
        if (!is_file($viewFile)) {
            throw new \Exception("View not found: {$viewFile}");
        }

        extract($data);

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        if ($layout === null) {
            echo $content;
            return;
        }

        $layoutFile = __DIR__ . '/../Views/layouts/' . $layout . '.php'; // กำหนด path ให้ตรง
        if (!is_file($layoutFile)) {
            throw new \Exception("Layout not found: {$layoutFile}");
        }

        require $layoutFile;
    }
}
