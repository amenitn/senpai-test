/*! For license information please see senpai-wp-form-public.js.LICENSE.txt */
(()=>{var __webpack_modules__={"./src/form.js":()=>{eval('jQuery(document).ready(function ($) {\n  $(\'#submit\').on(\'click\', function () {\n    event.preventDefault();\n    let name = $(\'#name\').val();\n    let email = $(\'#email\').val();\n    let phone = $(\'#phone\').val();\n    let message = $(\'#message\').val();\n    let settings = {\n      "url": senpai_form_ajax_params.ajaxurl,\n      "method": "POST",\n      "data": {\n        "nonce": senpai_form_ajax_params.nonce,\n        "action": "senpai_public_form_ajax",\n        "name": name,\n        "email": email,\n        "phone": phone,\n        "message": message\n      }\n    };\n    $.ajax(settings).done(function (response) {});\n  });\n  document.getElementById(\'myForm_public\').reset();\n  window.location.reload();\n});\n\n//# sourceURL=webpack://tw_wp5/./src/form.js?')}},__webpack_exports__={};__webpack_modules__["./src/form.js"]()})();