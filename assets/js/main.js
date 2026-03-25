$(document).ready(function () {
  showTbListTeacher();

  async function getAllTeacher() {
    try {
      const result = await $.ajax({
        url: `${window.APP_BASE}/list`,
        method: "GET",
        dataType: "JSON",
      });

      // console.log(result);
      if (result.status == "success" && result.data.length > 0) {
        return result.data;
      } else {
        return null;
      }
    } catch (error) {
      console.log(error);

      return null;
    }
  }

  async function showTbListTeacher() {
    const teachers = await getAllTeacher();
    const $tbody = $("#list tbody").empty();

    if (!Array.isArray(teachers) || teachers.length === 0) {
      $tbody.append(`
      <tr class="text-center">
        <td colspan="3">ไม่พบข้อมูล</td>
      </tr>
    `);
      return;
    }

    const html = teachers
      .map(
        (item, i) => `
      <tr>
        <td>${i + 1}</td>
        <td>${item.FirstNameTH ?? ""}</td>
        <td>${item.LastNameTH ?? ""}</td>
      </tr>
    `,
      )
      .join("");

    $tbody.append(html);
  }
});
