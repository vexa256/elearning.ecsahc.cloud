(()=>{"use strict";var t,n,e,a,i=(a=function(n){[].slice.call(t.querySelectorAll("[data-kt-plan-price-month]")).map((function(t){var e=t.getAttribute("data-kt-plan-price-month"),a=t.getAttribute("data-kt-plan-price-annual");"month"===n?t.innerHTML=e:"annual"===n&&(t.innerHTML=a)}))},{init:function(){(t=document.querySelector("#kt_modal_upgrade_plan"))&&(n=t.querySelector('[data-kt-plan="month"]'),e=t.querySelector('[data-kt-plan="annual"]'),n.addEventListener("click",(function(t){a("month")})),e.addEventListener("click",(function(t){a("annual")})),KTUtil.on(t,'[data-bs-toggle="tab"]',"click",(function(t){this.querySelector('[type="radio"]').checked=!0})))}});KTUtil.onDOMContentLoaded((function(){i.init()}))})();
//# sourceMappingURL=upgrade-plan.js.map