// function BootEditor() {}
function BootEditor() {}
$(document).ready(function () {
  if ($("#PrintCertificate").length > 0) {
    // alert("true");
    $("#PrintCertificate").on("click", function () {
      $.print("#printable");
    });

    $("#printable")
      .find("#PrintCertificate")
      .on("click", function () {});
  }
  if ($("#AttemptPreTestExamModalWindow").length) {
    var myModal = new bootstrap.Modal(
      document.getElementById("AttemptPreTestExamModalWindow"),
      {
        keyboard: false,
        backdrop: "static",
      }
    );

    myModal.show();

    Swal.fire(
      "Attempt Pre-Test",
      "Hello, Please attempt the course Pre-Test to proceed to further in the course"
    );

    // alert("Very True");
  }
  if ($("#AttemptModularExamModalWindow").length) {
    var myModal = new bootstrap.Modal(
      document.getElementById("AttemptModularExamModalWindow"),
      {
        keyboard: false,
        backdrop: "static",
      }
    );

    myModal.show();
  }
  if ($("#AttemptPostExamModalWindow").length) {
    var myModal = new bootstrap.Modal(
      document.getElementById("AttemptPostExamModalWindow"),
      {
        keyboard: false,
        backdrop: "static",
      }
    );

    myModal.show();
  }
  if ($("#AttemptPracticalExamModalWindow").length) {
    var myModal = new bootstrap.Modal(
      document.getElementById("AttemptPracticalExamModalWindow"),
      {
        keyboard: false,
        backdrop: "static",
      }
    );

    myModal.show();
  }
  if ($(".wizard").length) {
    $(".wizard").steps({
      headerTag: "h3",
      bodyTag: "section",
      // transitionEffect: "slideLeft",
      autoFocus: true,
      onFinished: function (event, currentIndex) {
        $(".wizard").submit();
      },
    });
  }

  if ($(".IntOnly").length) {
    $(".IntOnly").keypress(function (e) {
      var charCode = e.which ? e.which : event.keyCode;
      if (String.fromCharCode(charCode).match(/[^0-9]/g)) return false;
    });
  }

  $(document).on("click", ".Certify", function () {
    Swal.fire("OOOPS", "Please complete all exams to certify", "info");
  });

  $(document).on("click", ".CompleteAction", function () {
    Swal.fire(
      "OOOPS",
      "Please complete all exams to execute this action",
      "info"
    );
  });

  $(document).on("click", ".Feed", function () {
    Swal.fire(
      "OOOPS",
      "You have to interact with this course and its resources for more than 7 days to submit feedback",
      "info"
    );
  });

  if ($(".deleteConfirm").length) {
    $(document).on("click", ".deleteConfirm", function () {
      var route = $(this).data("route");
      var msg = $(this).data("msg");

      Swal.fire({
        title: "Are you sure?",
        text: msg,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = route;
        }
      });
    });
  }

  //   if ($("#kt_stepper_example_basic").length > 0) {
  //     // Stepper lement
  //     var element = document.querySelector("#kt_stepper_example_basic");

  //     // Initialize Stepper
  //     var stepper = new KTStepper(element);

  //     // Handle next step
  //     stepper.on("kt.stepper.next", function (stepper) {
  //       stepper.goNext(); // go next step
  //     });

  //     // Handle previous step
  //     stepper.on("kt.stepper.previous", function (stepper) {
  //       stepper.goPrevious(); // go previous step
  //     });
  //   }

  //   if ($("select").length) {
  //     $(function () {
  //       $("select").selectize({
  //         create: false,
  //         sortField: "text",
  //       });
  //     });
  //   }
  //   if ($(".mytable").length) {
  //     $(".mytable").DataTable({
  //       paging: true,
  //       lengthChange: true,
  //       searching: true,
  //       pageLength: 15,
  //       ordering: true,
  //       info: true,
  //       autoWidth: true,
  //       responsive: true,
  //       dom: "Bfrtip",

  //       buttons: ["excel"],
  //     });
  //   }

  $(".tox-statusbar__branding").hide();

  //   setInterval(function () {
  //     $(".paginate_button").addClass("bg-dark text-light shadow-lg");
  //   }, 1000);
});

/***Plugins  INtOnly INput*/

(function (a) {
  a.fn.extend({
    inputNumberFormat: function (c) {
      this.defaultOptions = {
        decimal: 2,
        decimalAuto: 2,
        separator: ".",
        separatorAuthorized: [".", ","],
        allowNegative: false,
      };
      var e = a.extend({}, this.defaultOptions, c);
      var d = function (i, f) {
        var h = [];

        var g = "^[0-9]+";
        if (f.allowNegative) {
          g = "^-{0,1}[0-9]*";
        }
        if (f.decimal) {
          g +=
            "[" +
            f.separatorAuthorized.join("") +
            "]?[0-9]{0," +
            f.decimal +
            "}";
          g = new RegExp(g + "$");
          h = i.match(g);
          if (!h) {
            g =
              "^[" +
              f.separatorAuthorized.join("") +
              "][0-9]{0," +
              f.decimal +
              "}";
            g = new RegExp(g + "$");
            h = i.match(g);
          }
        } else {
          g = new RegExp(g + "$");
          h = i.match(g);
        }
        return h;
      };
      var b = function (k, f) {
        var j = k;
        if (!j) {
          return j;
        }
        if (j == "-") {
          return "";
        }
        j = j.replace(",", f.separator);
        if (f.decimal && f.decimalAuto) {
          j =
            Math.round(j * Math.pow(10, f.decimal)) / Math.pow(10, f.decimal) +
            "";
          if (j.indexOf(f.separator) === -1) {
            j += f.separator;
          }
          var h = f.decimalAuto - j.split(f.separator)[1].length;
          for (var g = 1; g <= h; g++) {
            j += "0";
          }
        }
        return j;
      };
      return this.each(function () {
        var f = a(this);
        f.on("keypress", function (j) {
          if (j.ctrlKey) {
            return;
          }
          if (j.key.length > 1) {
            return;
          }
          var i = a.extend({}, e, a(this).data());
          var g = a(this).val().substr(0, j.target.selectionStart);
          var h = a(this)
            .val()
            .substr(j.target.selectionEnd, a(this).val().length - 1);
          var k = g + j.key + h;
          if (!d(k, i)) {
            j.preventDefault();
            return;
          }
        });
        f.on("blur", function (h) {
          var g = a.extend({}, e, a(this).data());
          a(this).val(b(a(this).val(), g));
        });
        f.on("change", function (h) {
          var g = a.extend({}, e, a(this).data());
          a(this).val(b(a(this).val(), g));
        });
      });
    },
  });
})(jQuery);
/***Plugins */

$(function () {
  $("a[href='#']").on("click", function (e) {
    e.preventDefault();
  });

  $("input[type='search']").removeClass("form-control-solid");

  $(".table").addClass("table-bordered");

  if ($("#inputMonthlySalary").length > 0) {
    $("#inputMonthlySalary").inputNumberFormat();

    $("#labelMonthlySalary").html("Monthly salary (UGX)");
  }

  if ($("#inputAmount").length > 0) {
    $("#inputAmount").inputNumberFormat();
  }

  if ($(".IntOnlyNow").length > 0) {
    $(".IntOnlyNow").inputNumberFormat();
  }

  if ($("#DinputAmount").length > 0) {
    $("#DinputAmount").inputNumberFormat();
  }

  if ($("#BinputAmount").length > 0) {
    $("#BinputAmount").inputNumberFormat();
  }
});

$(document).ready(function () {
  if ($(".PdfViewer").length) {
    $(document).on("click", ".PdfViewer", function () {
      var path = $(this).data("source");
      var doc = $(this).data("doc");
      PDFObject.embed(path, "#adobe-dc-view");
    });
  }
  if ($(".FPdfJS").length) {
    $(document).on("click", ".FPdfJS", function () {
      var path = $(this).data("source");
      var doc = $(this).data("doc");
      PDFObject.embed(path, "#adobe-dc-view");
    });
  }
  if ($("textarea.editorme").length > 0) {
    CKEDITOR.config.height = 300;
    setTimeout(function () {
      $("textarea.editorme").ckeditor();
    }, 700);
  }

  localStorage.openpages = Date.now();
  window.addEventListener(
    "storage",
    function (e) {
      if (e.key == "openpages") {
        // Listen if anybody else is opening the same page!
        localStorage.page_available = Date.now();
      }
      if (e.key == "page_available") {
        document.querySelector("body").innerHTML =
          "<h1> The system has detected that you have multiple tabs of the application open. Please close this active tab now. More attempts could lead to account cancellation</h1>";
      }
    },
    false
  );
});
