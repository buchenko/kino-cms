define({ "api": [
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./api/web/main.js",
    "group": "C__WebServers_home_kino_cms_local_api_api_web_main_js",
    "groupTitle": "C__WebServers_home_kino_cms_local_api_api_web_main_js",
    "name": ""
  },
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./web/doc/main.js",
    "group": "C__WebServers_home_kino_cms_local_api_web_doc_main_js",
    "groupTitle": "C__WebServers_home_kino_cms_local_api_web_doc_main_js",
    "name": ""
  },
  {
    "type": "POST",
    "url": "/auth",
    "title": "Авторизация пользователя для получения токена доступа",
    "name": "auth",
    "group": "___________",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>user name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>user password</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "result",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "result.token",
            "description": "<p>user token</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "result.expired",
            "description": "<p>datetime token expired</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./controllers/SiteController.php",
    "groupTitle": "___________",
    "sampleRequest": [
      {
        "url": "https://kino-cms.local/auth"
      }
    ]
  },
  {
    "type": "PUT, PATH",
    "url": "/ticket/:id",
    "title": "Оплата билета",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "authorization",
            "description": "<p>Bearer or Basic user token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{ \"Authorization\": \"Bearer FWZf3OtFy-YR7rcFUC7WzRlM3o7eoGd5\" }",
          "type": "json"
        }
      ]
    },
    "name": "pay",
    "group": "______",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "result",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "result.id",
            "description": "<p>ticket id</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "result.paid",
            "description": "<p>ticket paid status</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Object[]",
            "optional": false,
            "field": "errors",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "errors.field",
            "description": "<p>field name on error</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "errors.message",
            "description": "<p>error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./controllers/TicketController.php",
    "groupTitle": "______",
    "sampleRequest": [
      {
        "url": "https://kino-cms.local/ticket/:id"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/ticket",
    "title": "Бронирование билета",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "authorization",
            "description": "<p>Bearer or Basic user token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{ \"Authorization\": \"Bearer FWZf3OtFy-YR7rcFUC7WzRlM3o7eoGd5\" }",
          "type": "json"
        }
      ]
    },
    "name": "reserve",
    "group": "______",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Object",
            "optional": false,
            "field": "ticket",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "ticket.showtime_id",
            "description": "<p>showtime id</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "ticket.seat_id",
            "description": "<p>seat id</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "ticket.user_id",
            "description": "<p>user id</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "result",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "result.id",
            "description": "<p>ticket id</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "result.paid",
            "description": "<p>ticket paid status</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Object[]",
            "optional": false,
            "field": "errors",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "errors.field",
            "description": "<p>field name on error</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "errors.message",
            "description": "<p>error message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "./controllers/TicketController.php",
    "groupTitle": "______",
    "sampleRequest": [
      {
        "url": "https://kino-cms.local/ticket"
      }
    ]
  }
] });
