let mix = require("laravel-mix");

mix
  .react(
    "src/admin/react/Login/Login.jsx",
    "public/assets/admin/login/login.js"
  )
  .react(
    "src/admin/react/Layouts/MainLayout.jsx",
    "public/assets/admin/layouts/main_layout.js"
  )
  .react("src/admin/react/User/Index.jsx", "public/assets/admin/user/index.js")
  .react("src/admin/react/Role/Index.jsx", "public/assets/admin/role/index.js");
