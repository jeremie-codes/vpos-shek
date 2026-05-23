  (() => {
    window.Helpers.initCustomOptionCheck();

    let inputs= document.querySelectorAll(".contact-number-mask"), // configuration des inputs de contact
    o = $("#activityProvince");

    console.log(o)
    
  inputs &&
    (inputs.forEach((t) => {
      t.addEventListener("input", (e) => {
        let value = e.target.value.replace(/\D/g, "");
        t.value = formatGeneral(value, {
          blocks: [3, 3, 4],
          delimiters: [" ", " "]
        });
      });
    })),

    // configuration du select
  o &&
    (o.wrap('<div class="position-relative"></div>'),
    o.select2({ placeholder: "Select pays", dropdownParent: o.parent() }));

  // Stepper Form (buton next/prev et validation des formulaires)
  let is = $("#isoCode");
  is.length &&
    (is.wrap('<div class="position-relative"></div>'),
    is
      .select2({
        placeholder: "Select Code",
        dropdownParent: is.parent(),
      })
      .on("change", function () {
        is.revalidateField("isoCode");
    }));

  let activityPhoneiso = $("#activityPhone1_iso");
  activityPhoneiso.length &&
    (activityPhoneiso.wrap('<div class="position-relative"></div>'),
    activityPhoneiso
      .select2({
        placeholder: "Select Code",
        dropdownParent: activityPhoneiso.parent(),
      })
      .on("change", function () {
        activityPhoneiso.revalidateField("activityPhone1_iso");
    }));

  mo = $("#mobile");
  mo.length &&
    (mo.wrap('<div class="position-relative"></div>'),
    mo
      .select2({
        placeholder: "Select Code",
        dropdownParent: mo.parent(),
      })
      .on("change", function () {
        mo.revalidateField("mobile");
    }));

  ph = $("#phone_code");
  ph.length &&
    (ph.wrap('<div class="position-relative"></div>'),
    ph
      .select2({
        placeholder: "Select Code",
        dropdownParent: ph.parent(),
      })
      .on("change", function () {
        ph.revalidateField("phone_code");
      }));

  shcountry = $("#shCountry");
  shcountry.length &&
    (shcountry.wrap('<div class="position-relative"></div>'),
    shcountry
      .select2({
        placeholder: "Select pays",
        dropdownParent: shcountry.parent(),
      })
      .on("change", function () {

      }));

  actSector = $("#activity_sector");
  actSector.length &&
    (actSector.wrap('<div class="position-relative"></div>'),
    actSector
      .select2({
        placeholder: "Select activité",
        dropdownParent: actSector.parent(),
      })
      .on("change", function () {
        actSector.revalidateField("activity_sector");
      }));

})();
