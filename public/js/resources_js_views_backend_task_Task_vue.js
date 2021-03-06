"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_views_backend_task_Task_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/backend/task/Task.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/backend/task/Task.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }



function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "Task",
  components: {
    Header: function Header() {
      return __webpack_require__.e(/*! import() */ "resources_js_components_Header_vue").then(__webpack_require__.bind(__webpack_require__, /*! ../../../components/Header */ "./resources/js/components/Header.vue"));
    },
    Nav: function Nav() {
      return __webpack_require__.e(/*! import() */ "resources_js_components_Nav_vue-_422b0").then(__webpack_require__.bind(__webpack_require__, /*! ../../../components/Nav.vue */ "./resources/js/components/Nav.vue"));
    }
  },
  data: function data() {
    return {
      task: {},
      message: {
        description: ""
      }
    };
  },
  created: function created() {
    this.getTask(this.$route.params.id);
  },
  methods: {
    getTask: function getTask(id) {
      var _this = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
        var api_url, response;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                api_url = "http://127.0.0.1:8000/api/v1/" + 'tasks/';
                _context.next = 3;
                return axios.get(api_url + id, {
                  headers: {
                    Authorization: "Bearer ".concat(localStorage.getItem("token"))
                  }
                });

              case 3:
                response = _context.sent;
                _this.task = response.data.data;

              case 5:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    commentOnTask: function commentOnTask(id) {
      var _this2 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee2() {
        var api_url, response;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                api_url = "http://127.0.0.1:8000/api/v1/" + 'tasks/';
                _context2.prev = 1;
                _context2.next = 4;
                return axios.post(api_url + id, {
                  status_description: _this2.message.description,
                  _method: "patch"
                }, {
                  headers: {
                    Authorization: "Bearer ".concat(localStorage.getItem("token"))
                  }
                });

              case 4:
                response = _context2.sent;

                _this2.$toasted.success(response.data.message);

                _context2.next = 11;
                break;

              case 8:
                _context2.prev = 8;
                _context2.t0 = _context2["catch"](1);

                _this2.$toasted.error(_context2.t0.response.data.message);

              case 11:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, null, [[1, 8]]);
      }))();
    },
    formatDate: function formatDate(dateString) {
      var options = {
        year: "numeric",
        month: "long",
        day: "numeric"
      };
      return new Date(dateString).toLocaleDateString(undefined, options);
    }
  },
  computed: _objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_1__.mapGetters)(["user"]))
});

/***/ }),

/***/ "./resources/js/views/backend/task/Task.vue":
/*!**************************************************!*\
  !*** ./resources/js/views/backend/task/Task.vue ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Task_vue_vue_type_template_id_e3069d76_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Task.vue?vue&type=template&id=e3069d76&scoped=true& */ "./resources/js/views/backend/task/Task.vue?vue&type=template&id=e3069d76&scoped=true&");
/* harmony import */ var _Task_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Task.vue?vue&type=script&lang=js& */ "./resources/js/views/backend/task/Task.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Task_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Task_vue_vue_type_template_id_e3069d76_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _Task_vue_vue_type_template_id_e3069d76_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "e3069d76",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/backend/task/Task.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/views/backend/task/Task.vue?vue&type=script&lang=js&":
/*!***************************************************************************!*\
  !*** ./resources/js/views/backend/task/Task.vue?vue&type=script&lang=js& ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Task_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Task.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/backend/task/Task.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Task_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/backend/task/Task.vue?vue&type=template&id=e3069d76&scoped=true&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/views/backend/task/Task.vue?vue&type=template&id=e3069d76&scoped=true& ***!
  \*********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Task_vue_vue_type_template_id_e3069d76_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Task_vue_vue_type_template_id_e3069d76_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Task_vue_vue_type_template_id_e3069d76_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Task.vue?vue&type=template&id=e3069d76&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/backend/task/Task.vue?vue&type=template&id=e3069d76&scoped=true&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/backend/task/Task.vue?vue&type=template&id=e3069d76&scoped=true&":
/*!************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/backend/task/Task.vue?vue&type=template&id=e3069d76&scoped=true& ***!
  \************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      {
        staticClass:
          "d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary",
      },
      [
        _c("Nav"),
        _vm._v(" "),
        _c("div", { staticClass: "h-screen flex-grow-1 overflow-y-lg-auto" }, [
          _c(
            "header",
            { staticClass: "bg-surface-primary border-bottom pt-6 pb-5" },
            [
              _c("div", { staticClass: "container-fluid" }, [
                _c("div", { staticClass: "mb-npx" }, [
                  _c("div", { staticClass: "row align-items-center" }, [
                    _vm._m(0),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-sm-6 col-12 text-sm-end" }, [
                      _c("div", { staticClass: "mx-n1" }, [
                        !_vm.task.status
                          ? _c(
                              "button",
                              {
                                staticClass:
                                  "btn d-inline-flex btn-sm btn-dark mx-1",
                                attrs: {
                                  "data-toggle": "modal",
                                  "data-target": "#form",
                                },
                              },
                              [
                                _vm._m(1),
                                _vm._v(" "),
                                _c("span", [_vm._v("Comment on Task")]),
                              ]
                            )
                          : _vm._e(),
                      ]),
                    ]),
                  ]),
                ]),
              ]),
            ]
          ),
          _vm._v(" "),
          _c("main", { staticClass: "py-6 bg-surface-secondary" }, [
            _c("div", { staticClass: "container-fluid" }, [
              _c("header", { staticClass: "header" }, [
                _c("div", { staticClass: "container" }, [
                  _c("div", { staticClass: "teacher-name" }, [
                    _c("div", { staticClass: "row" }, [
                      _c("div", { staticClass: "col-sm-9" }, [
                        _c("h2", [
                          _vm._v("Task Title :  "),
                          _c("small", [_vm._v(_vm._s(_vm.task.title))]),
                        ]),
                      ]),
                    ]),
                  ]),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass: "row",
                      staticStyle: { "margin-top": "20px" },
                    },
                    [
                      _c("div", { staticClass: "col-sm-12" }, [
                        _c("p", { staticClass: "text-justify" }, [
                          _vm._v(" " + _vm._s(_vm.task.description) + " "),
                        ]),
                      ]),
                      _vm._v(" "),
                      _c("br"),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-sm-12" }, [
                        _vm._v(
                          "\n                                   Task Status :\n                                    "
                        ),
                        _vm.task.status
                          ? _c("strong", { staticClass: "text-success" }, [
                              _vm._v("Completed"),
                            ])
                          : _c("strong", { staticClass: "text-danger" }, [
                              _vm._v("Not Completed"),
                            ]),
                      ]),
                    ]
                  ),
                ]),
              ]),
            ]),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass: "modal fade",
                attrs: {
                  id: "form",
                  tabindex: "-1",
                  role: "dialog",
                  "aria-labelledby": "exampleModalLabel",
                  "aria-hidden": "true",
                },
              },
              [
                _c(
                  "div",
                  {
                    staticClass: "modal-dialog modal-dialog-centered",
                    attrs: { role: "document" },
                  },
                  [
                    _c("div", { staticClass: "modal-content" }, [
                      _vm._m(2),
                      _vm._v(" "),
                      _c("div", [
                        _c("div", { staticClass: "modal-body" }, [
                          _c("div", { staticClass: "form-group" }, [
                            _c("label", { attrs: { for: "desc" } }, [
                              _vm._v("Message"),
                            ]),
                            _vm._v(" "),
                            _c("textarea", {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.message.description,
                                  expression: "message.description",
                                },
                              ],
                              staticClass: "form-control form-control-md",
                              attrs: {
                                id: "desc",
                                placeholder: "Enter task description",
                                rows: "6",
                                "aria-label": "With textarea",
                              },
                              domProps: { value: _vm.message.description },
                              on: {
                                input: function ($event) {
                                  if ($event.target.composing) {
                                    return
                                  }
                                  _vm.$set(
                                    _vm.message,
                                    "description",
                                    $event.target.value
                                  )
                                },
                              },
                            }),
                          ]),
                        ]),
                        _vm._v(" "),
                        _c(
                          "div",
                          { staticClass: "modal-footer border-top-0" },
                          [
                            _c(
                              "button",
                              {
                                staticClass: "btn btn-sm btn-dark",
                                attrs: { type: "submit" },
                                on: {
                                  click: function ($event) {
                                    return _vm.commentOnTask(_vm.task.id)
                                  },
                                },
                              },
                              [_vm._v("Create")]
                            ),
                          ]
                        ),
                      ]),
                    ]),
                  ]
                ),
              ]
            ),
          ]),
        ]),
      ],
      1
    ),
  ])
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-sm-6 col-12 mb-4 mb-sm-0" }, [
      _c("h1", { staticClass: "h2 mb-0 ls-tight" }, [_vm._v("Task details")]),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("span", { staticClass: " pe-2" }, [
      _c("i", { staticClass: "bi bi-plus" }),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header border-bottom-0" }, [
      _c("h5", { staticClass: "modal-title" }, [_vm._v("Comment on Task")]),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: {
            type: "button",
            "data-dismiss": "modal",
            "aria-label": "Close",
          },
        },
        [_c("span", { attrs: { "aria-hidden": "true" } }, [_vm._v("??")])]
      ),
    ])
  },
]
render._withStripped = true



/***/ })

}]);