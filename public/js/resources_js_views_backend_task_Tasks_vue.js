"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_views_backend_task_Tasks_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/backend/task/Tasks.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/backend/task/Tasks.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

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
  name: "Tasks",
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
      tasks: [],
      pagination: {}
    };
  },
  created: function created() {
    this.getAllTask();
  },
  computed: _objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_1__.mapGetters)(["user"])),
  methods: {
    getAllTask: function getAllTask(page_url) {
      var _this = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
        var vm, response;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                vm = _this;
                page_url = page_url || 'tasks';
                _context.next = 4;
                return axios.get("http://127.0.0.1:8000/api/v1/" + page_url, {
                  headers: {
                    Authorization: "Bearer ".concat(localStorage.getItem("token"))
                  }
                });

              case 4:
                response = _context.sent;
                _this.tasks = response.data.data;
                vm.makePagination(response.data.meta, response.data.links);

              case 7:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    makePagination: function makePagination(meta, links) {
      this.pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
    },
    formatDate: function formatDate(dateString) {
      var options = {
        year: "numeric",
        month: "long",
        day: "numeric"
      };
      return new Date(dateString).toLocaleDateString(undefined, options);
    },
    clearData: function clearData() {
      this.project.title = "";
      this.project.duration = "";
      this.project.description = "";
    }
  }
});

/***/ }),

/***/ "./resources/js/views/backend/task/Tasks.vue":
/*!***************************************************!*\
  !*** ./resources/js/views/backend/task/Tasks.vue ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Tasks_vue_vue_type_template_id_44c5187e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Tasks.vue?vue&type=template&id=44c5187e&scoped=true& */ "./resources/js/views/backend/task/Tasks.vue?vue&type=template&id=44c5187e&scoped=true&");
/* harmony import */ var _Tasks_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Tasks.vue?vue&type=script&lang=js& */ "./resources/js/views/backend/task/Tasks.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Tasks_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Tasks_vue_vue_type_template_id_44c5187e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _Tasks_vue_vue_type_template_id_44c5187e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "44c5187e",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/backend/task/Tasks.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/views/backend/task/Tasks.vue?vue&type=script&lang=js&":
/*!****************************************************************************!*\
  !*** ./resources/js/views/backend/task/Tasks.vue?vue&type=script&lang=js& ***!
  \****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Tasks_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Tasks.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/backend/task/Tasks.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Tasks_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/backend/task/Tasks.vue?vue&type=template&id=44c5187e&scoped=true&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/views/backend/task/Tasks.vue?vue&type=template&id=44c5187e&scoped=true& ***!
  \**********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Tasks_vue_vue_type_template_id_44c5187e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Tasks_vue_vue_type_template_id_44c5187e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Tasks_vue_vue_type_template_id_44c5187e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Tasks.vue?vue&type=template&id=44c5187e&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/backend/task/Tasks.vue?vue&type=template&id=44c5187e&scoped=true&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/backend/task/Tasks.vue?vue&type=template&id=44c5187e&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/backend/task/Tasks.vue?vue&type=template&id=44c5187e&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************************/
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
          _vm._m(0),
          _vm._v(" "),
          _c("main", { staticClass: "py-6 bg-surface-secondary" }, [
            _c("div", { staticClass: "container-fluid" }, [
              _c("div", { staticClass: "card shadow border-0 mb-7" }, [
                _vm._m(1),
                _vm._v(" "),
                _c("div", { staticClass: "table-responsive" }, [
                  _c(
                    "table",
                    { staticClass: "table table-hover table-nowrap" },
                    [
                      _vm._m(2),
                      _vm._v(" "),
                      _c(
                        "tbody",
                        _vm._l(_vm.tasks, function (task, index) {
                          return _c("tr", { key: task.id }, [
                            _c("td", [_vm._v(_vm._s(index + 1))]),
                            _vm._v(" "),
                            _c("td", [_vm._v(" " + _vm._s(task.title))]),
                            _vm._v(" "),
                            _c("td", [
                              _vm._v(" " + _vm._s(task.project.title) + " "),
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _vm._v(
                                " " +
                                  _vm._s(task.project.project_duration) +
                                  " "
                              ),
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              task.status
                                ? _c(
                                    "strong",
                                    { staticClass: "text-success" },
                                    [_vm._v("Completed")]
                                  )
                                : _c("strong", { staticClass: "text-danger" }, [
                                    _vm._v("Not Completed"),
                                  ]),
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _vm._v(
                                "\n                                        " +
                                  _vm._s(_vm.formatDate(task.created_at)) +
                                  "\n                                    "
                              ),
                            ]),
                            _vm._v(" "),
                            _c(
                              "td",
                              { staticClass: "text-end" },
                              [
                                _c(
                                  "router-link",
                                  {
                                    staticClass: "btn btn-sm btn-neutral",
                                    attrs: { to: "/task/" + task.id },
                                  },
                                  [_vm._v("View")]
                                ),
                              ],
                              1
                            ),
                          ])
                        }),
                        0
                      ),
                    ]
                  ),
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "card-footer border-0 py-5" }, [
                  _c("nav", { attrs: { "aria-label": "..." } }, [
                    _c("ul", { staticClass: "pagination" }, [
                      _c(
                        "li",
                        {
                          staticClass: "page-item",
                          class: [{ disabled: !_vm.pagination.prev_page_url }],
                        },
                        [
                          _c(
                            "a",
                            {
                              staticClass: "page-link",
                              attrs: { href: "#", tabindex: "-1" },
                              on: {
                                click: function ($event) {
                                  return _vm.getAllTask(
                                    _vm.pagination.prev_page_url
                                  )
                                },
                              },
                            },
                            [_vm._v("Previous")]
                          ),
                        ]
                      ),
                      _vm._v(" "),
                      _c("li", { staticClass: "page-item disabled" }, [
                        _c(
                          "a",
                          { staticClass: "page-link", attrs: { href: "#" } },
                          [
                            _vm._v(
                              "Page " +
                                _vm._s(_vm.pagination.current_page) +
                                " of " +
                                _vm._s(_vm.pagination.last_page) +
                                " "
                            ),
                          ]
                        ),
                      ]),
                      _vm._v(" "),
                      _c(
                        "li",
                        {
                          staticClass: "page-item",
                          class: [{ disabled: !_vm.pagination.next_page_url }],
                        },
                        [
                          _c(
                            "a",
                            {
                              staticClass: "page-link",
                              attrs: { href: "#" },
                              on: {
                                click: function ($event) {
                                  return _vm.getAllTask(
                                    _vm.pagination.next_page_url
                                  )
                                },
                              },
                            },
                            [_vm._v("Next")]
                          ),
                        ]
                      ),
                    ]),
                  ]),
                ]),
              ]),
            ]),
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
    return _c(
      "header",
      { staticClass: "bg-surface-primary border-bottom pt-6 pb-5" },
      [
        _c("div", { staticClass: "container-fluid" }, [
          _c("div", { staticClass: "mb-npx" }, [
            _c("div", { staticClass: "row align-items-center" }, [
              _c("div", { staticClass: "col-sm-6 col-12 mb-4 mb-sm-0" }, [
                _c("h1", { staticClass: "h2 mb-0 ls-tight" }, [
                  _vm._v("My task list"),
                ]),
              ]),
            ]),
          ]),
        ]),
      ]
    )
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-header" }, [
      _c("h5", { staticClass: "mb-0" }, [_vm._v("All My Tasks")]),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", { staticClass: "thead-light" }, [
      _c("tr", [
        _c("th", { attrs: { scope: "col" } }, [_vm._v("No..")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Title")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Project Title")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Project Duration")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Status")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Date")]),
        _vm._v(" "),
        _c("th"),
      ]),
    ])
  },
]
render._withStripped = true



/***/ })

}]);