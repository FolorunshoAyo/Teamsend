<!DOCTYPE html>
<html>
  <head>
    <title>{{ $pageTitle }}</title>
    @php
        $reformatted_org_name = strtolower(join("-", explode(" ", $organisation->name)));
        $template = ($templateDetails->template_html !== ""? "$templateDetails->template_file_destination" : "asset('email-builder/templates/default/' . $templateDetails->design_template . '/index.html')}}")
    @endphp
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
      href="https://teamsource.net/wp-content/uploads/2023/05/TeamSource-Favicon.png"
      rel="icon"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="{{asset('email-builder/dist/builder.css')}}" />
    <script src="{{asset('email-builder/dist/builder.js')}}"></script>

    <!-- @RSS Plugin -->
    <script src="{{asset('email-builder/plugins/rss/RssElement.js')}}"></script>
    <script src="{{asset('email-builder/plugins/rss/RssControl.js')}}"></script>
    <script src="{{asset('email-builder/plugins/rss/RssWidget.js')}}"></script>

    <script>
      // Builder parameters
      var params = new URLSearchParams(window.location.search);
      var strict = params.get("type") == "custom" ? false : true;
      var template = "{{ $templateDetails->design_template }}";

      console.log("Template: ", template, "\n", "Strict: ", strict);

      var templates = [
        {
          name: "Blank",
          //url: "design.php?id=6037a0a8583a7&type=default",
          url: `{{asset('email-builder/templates/default/blank/index.html')}}`,
          thumbnail: "email-builder\/templates\/default\/blank\/thumb.png",
        },
        {
          name: "Pricing Table",
          url: "email-builder.html?template=pricing-table&type=default",
          thumbnail: "email-builder\/templates\/default\/pricing-table\/thumb.png",
        },
        {
          name: "Listing & Tables",
          url: "email-builder.html?template=listing-and-tables&type=default",
          thumbnail: "email-builder\/templates\/default\/listing-and-tables\/thumb.png",
        },
        // {
        //   name: "Forms Building",
        //   url: "design.php?id=6037a23568208&type=default",
        //   thumbnail: "templates\/default\/6037a23568208\/thumb.png",
        // },
        {
          name: "1-2-1 column layout",
          url: "email-builder.html?template=1-2-1-column-layout&type=default",
          thumbnail: "email-builder\/templates\/default\/1-2-1-column-layout\/thumb.png",
        },
        {
          name: "1-2 column layout",
          url: "email-builder.html?template=1-2-1-column-layout&type=default",
          thumbnail: "email-builder\/templates\/default\/1-2-column-layout\/thumb.png",
        },
        {
          name: "1-3-1 column layout",
          url: "email-builder.html?template=1-3-1-column-layout&type=default",
          thumbnail: "email-builder\/templates\/default\/1-3-1-column-layout\/thumb.png",
        },
        {
          name: "1-3-2 column layout",
          url: "email-builder.html?template=1-3-2-column-layout&type=default",
          thumbnail: "email-builder\/templates\/default\/1-3-2-column-layout\/thumb.png",
        },
        {
          name: "1-3 column layout",
          url: "email-builder.html?template=1-3-column-layout&type=default",
          thumbnail: "email-builder\/templates\/default\/1-3-column-layout\/thumb.png",
        },
        {
          name: "One column layout",
          url: "email-builder.html?template=one-column-layout&type=default",
          thumbnail: "email-builder\/templates\/default\/one-column-layout\/thumb.png",
        },
        {
          name: "2-1-2 column layout",
          url: "email-builder.html?template=2-1-2-column-layout&type=default",
          thumbnail: "email-builder\/templates\/default\/2-1-2-column-layout\/thumb.png",
        },
        {
          name: "2-1 column layout",
          url: "email-builder.html?template=2-1-column-layout&type=default",
          thumbnail: "email-builder\/templates\/default\/2-1-column-layout\/thumb.png",
        },
        {
          name: "Two columns layout",
          url: "email-builder.html?template=two-columns-layout&type=default",
          thumbnail: "email-builder\/templates\/default\/two-columns-layout\/thumb.png",
        },
        {
          name: "3-1-3 column layout",
          url: "email-builder.html?template=3-1-3-column-layout&type=default",
          thumbnail: "email-builder\/templates\/default\/3-1-3-column-layout\/thumb.png",
        },
        {
          name: "Three columns layout",
          url: "email-builder.html?template=three-columns-layout&type=default",
          thumbnail: "email-builder\/templates\/default\/three-columns-layou\/thumb.png",
        },
      ];
      var tags = [
        // { type: "label", tag: "CONTACT_FIRST_NAME" },
        // { type: "label", tag: "CONTACT_LAST_NAME" },
        // { type: "label", tag: "CONTACT_FULL_NAME" },
        // { type: "label", tag: "CONTACT_EMAIL" },
        // { type: "label", tag: "CONTACT_PHONE" },
        // { type: "label", tag: "CONTACT_ADDRESS" },
        // { type: "label", tag: "ORDER_ID" },
        // { type: "label", tag: "ORDER_DUE" },
        // { type: "label", tag: "ORDER_TAX" },
        // { type: "label", tag: "PRODUCT_NAME" },
        // { type: "label", tag: "PRODUCT_PRICE" },
        // { type: "label", tag: "PRODUCT_QTY" },
        // { type: "label", tag: "PRODUCT_SKU" },
        // { type: "label", tag: "AGENT_NAME" },
        // { type: "label", tag: "AGENT_SIGNATURE" },
        // { type: "label", tag: "AGENT_MOBILE_PHONE" },
        // { type: "label", tag: "AGENT_ADDRESS" },
        // { type: "label", tag: "AGENT_WEBSITE" },
        // { type: "label", tag: "AGENT_DISCLAIMER" },
        // { type: "label", tag: "CURRENT_DATE" },
        // { type: "label", tag: "CURRENT_MONTH" },
        // { type: "label", tag: "CURRENT_YEAR" },
        // { type: "button", tag: "PERFORM_CHECKOUT", text: "Checkout" },
        // { type: "button", tag: "PERFORM_OPTIN", text: "Subscribe" },
        { type: "label", tag: "%LAST_NAME%" },
        { type: "label", tag: "%FIRST_NAME%" },
        { type: "label", tag: "%FULL_NAME%" },
        { type: "label", tag: "%EMAIL%" },            
        { type: "label", tag: "%UNSUBSCRIBE%" },            
      ];

      // new builder
      var editor = new Editor({
        emailMode: true,
        strict: strict, // default == true
        showInlineToolbar: true, // default == true
        logoImgUrl: "https://teamsource.net/wp-content/uploads/2023/05/TeamSource-Logo.png",
        root: "{{asset('email-builder/dist/')}}",
        url: "{{ $template }}",
        // urlBack: window.location.origin,
        urlBack: "{{ route('org-admin.email-templates', ['organisation' => "$reformatted_org_name"]) }}",
        uploadAssetUrl: "{{ route('org-admin.upload-template-image', ['organisation' => "$reformatted_org_name"]) }}",
        uploadAssetMethod: "POST",
        // uploadTemplateUrl: "",
        // uploadTemplateCallback: function (response) {
        //   window.location = response.url;
        // },
        saveUrl: "{{ route('org-admin.upload-template', ['organisation' => "$reformatted_org_name"]) }}", // You can try with other sample server scripts like: save-to-mysql.php or save-to-aws-s3.php
        saveMethod: "POST",
        data: {
          _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          type: "default"
        },
        templates: templates,
        tags: tags,
        changeTemplateCallback: function (url) {
          window.location = url;
        },

        /*
                    Disable features: 
                    change_template|export|save_close|footer_exit|help
                */
        // disableFeatures: [ 'change_template', 'export', 'save_close', 'footer_exit', 'help' ],
        // disableWidgets: [ 'TwoColumnsWidget', 'ThreeColumnsWidget' ],
        // Custom header for: save, changeTemplate, export
        // header: { "Authorize": "KEY-DFDJUELDFDKFJDK" },

        export: {
          url: "export.php",
        },
        backgrounds: [
          "{{asset('email-builder/assets/image/backgrounds/images1.jpg')}}",
          "{{asset('email-builder/assets/image/backgrounds/images2.jpg')}}",
          "{{asset('email-builder/assets/image/backgrounds/images3.jpg')}}",
          "{{asset('email-builder/assets/image/backgrounds/images4.png')}}",
          "{{asset('email-builder/assets/image/backgrounds/images5.jpg')}}",
          "{{asset('email-builder/assets/image/backgrounds/images6.jpg')}}",
          "{{asset('email-builder/assets/image/backgrounds/images9.jpg')}}",
          "{{asset('email-builder/assets/image/backgrounds/images11.jpg')}}",
          "{{asset('email-builder/assets/image/backgrounds/images12.jpg')}}",
          "{{asset('email-builder/assets/image/backgrounds/images13.jpg')}}",
          "{{asset('email-builder/assets/image/backgrounds/images14.jpg')}}",
          "{{asset('email-builder/assets/image/backgrounds/images15.jpg')}}",
          "{{asset('email-builder/assets/image/backgrounds/images16.jpg')}}",
          "{{asset('email-builder/assets/image/backgrounds/images17.png')}}",
        ],
      });

      // @RSS plugin
      // var rssWidget = new RssWidget({ handler: "rss.php" });
    //   editor.addWidget(rssWidget, { index: 10 });

      $(document).ready(function () {
        editor.init();
      });
    </script>

    <style>
      .lds-dual-ring {
        display: inline-block;
        width: 80px;
        height: 80px;
      }
      .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 30px;
        height: 30px;
        margin: 4px;
        border-radius: 80%;
        border: 2px solid #aaa;
        border-color: #007bff transparent #007bff transparent;
        animation: lds-dual-ring 1.2s linear infinite;
      }
      @keyframes lds-dual-ring {
        0% {
          transform: rotate(0deg);
        }
        100% {
          transform: rotate(360deg);
        }
      }
    </style>
  </head>
  <body class="overflow-hidden">
    <div
      style="
        text-align: center;
        height: 100vh;
        vertical-align: middle;
        padding: auto;
        display: flex;
      "
    >
      <div style="margin: auto" class="lds-dual-ring"></div>
    </div>

    <script>
      switch (window.location.protocol) {
        case "http:":
        case "https:":
          //remote file over http or https
          break;
        case "file:":
          alert(
            "Please put the builderjs/ folder into your document root and open it through a web URL"
          );
          window.location.href = "{{ route('org-admin.email-templates', ['organisation' => "$reformatted_org_name"]) }}";
          break;
        default:
        //some other protocol
      }
    </script>
  </body>
</html>
