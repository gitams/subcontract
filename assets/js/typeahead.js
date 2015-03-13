/*!
 * typeahead.js 0.10.5
 * https://github.com/twitter/typeahead.js
 * Copyright 2013-2014 Twitter, Inc. and other contributors; Licensed MIT
 */

!function (a) {
    var b = function () {
        "use strict";
        return{isMsie: function () {
                return/(msie|trident)/i.test(navigator.userAgent) ? navigator.userAgent.match(/(msie |rv:)(\d+(.\d+)?)/i)[2] : !1
            }, isBlankString: function (a) {
                return!a || /^\s*$/.test(a)
            }, escapeRegExChars: function (a) {
                return a.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&")
            }, isString: function (a) {
                return"string" == typeof a
            }, isNumber: function (a) {
                return"number" == typeof a
            }, isArray: a.isArray, isFunction: a.isFunction, isObject: a.isPlainObject, isUndefined: function (a) {
                return"undefined" == typeof a
            }, toStr: function (a) {
                return b.isUndefined(a) || null === a ? "" : a + ""
            }, bind: a.proxy, each: function (b, c) {
                function d(a, b) {
                    return c(b, a)
                }
                a.each(b, d)
            }, map: a.map, filter: a.grep, every: function (b, c) {
                var d = !0;
                return b ? (a.each(b, function (a, e) {
                    return(d = c.call(null, e, a, b)) ? void 0 : !1
                }), !!d) : d
            }, some: function (b, c) {
                var d = !1;
                return b ? (a.each(b, function (a, e) {
                    return(d = c.call(null, e, a, b)) ? !1 : void 0
                }), !!d) : d
            }, mixin: a.extend, getUniqueId: function () {
                var a = 0;
                return function () {
                    return a++
                }
            }(), templatify: function (b) {
                function c() {
                    return String(b)
                }
                return a.isFunction(b) ? b : c
            }, defer: function (a) {
                setTimeout(a, 0)
            }, debounce: function (a, b, c) {
                var d, e;
                return function () {
                    var f, g, h = this, i = arguments;
                    return f = function () {
                        d = null, c || (e = a.apply(h, i))
                    }, g = c && !d, clearTimeout(d), d = setTimeout(f, b), g && (e = a.apply(h, i)), e
                }
            }, throttle: function (a, b) {
                var c, d, e, f, g, h;
                return g = 0, h = function () {
                    g = new Date, e = null, f = a.apply(c, d)
                }, function () {
                    var i = new Date, j = b - (i - g);
                    return c = this, d = arguments, 0 >= j ? (clearTimeout(e), e = null, g = i, f = a.apply(c, d)) : e || (e = setTimeout(h, j)), f
                }
            }, noop: function () {
            }}
    }(), c = function () {
        return{wrapper: '<span class="twitter-typeahead"></span>', dropdown: '<span class="tt-dropdown-menu"></span>', dataset: '<div class="tt-dataset-%CLASS%"></div>', suggestions: '<span class="tt-suggestions"></span>', suggestion: '<div class="tt-suggestion"></div>'}
    }(), d = function () {
        "use strict";
        var a = {wrapper: {position: "relative", display: "inline-block"}, hint: {position: "absolute", top: "0", left: "0", borderColor: "transparent", boxShadow: "none", opacity: "1"}, input: {position: "relative", verticalAlign: "top", backgroundColor: "transparent"}, inputWithNoHint: {position: "relative", verticalAlign: "top"}, dropdown: {position: "absolute", top: "100%", left: "0", zIndex: "100", display: "none"}, suggestions: {display: "block"}, suggestion: {whiteSpace: "nowrap", cursor: "pointer"}, suggestionChild: {whiteSpace: "normal"}, ltr: {left: "0", right: "auto"}, rtl: {left: "auto", right: " 0"}};
        return b.isMsie() && b.mixin(a.input, {backgroundImage: "url(data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7)"}), b.isMsie() && b.isMsie() <= 7 && b.mixin(a.input, {marginTop: "-1px"}), a
    }(), e = function () {
        "use strict";
        function c(b) {
            b && b.el || a.error("EventBus initialized without el"), this.$el = a(b.el)
        }
        var d = "typeahead:";
        return b.mixin(c.prototype, {trigger: function (a) {
                var b = [].slice.call(arguments, 1);
                this.$el.trigger(d + a, b)
            }}), c
    }(), f = function () {
        "use strict";
        function a(a, b, c, d) {
            var e;
            if (!c)
                return this;
            for (b = b.split(i), c = d?h(c, d):c, this._callbacks = this._callbacks || {}; e = b.shift(); )
                this._callbacks[e] = this._callbacks[e] || {sync: [], async: []}, this._callbacks[e][a].push(c);
            return this
        }
        function b(b, c, d) {
            return a.call(this, "async", b, c, d)
        }
        function c(b, c, d) {
            return a.call(this, "sync", b, c, d)
        }
        function d(a) {
            var b;
            if (!this._callbacks)
                return this;
            for (a = a.split(i); b = a.shift(); )
                delete this._callbacks[b];
            return this
        }
        function e(a) {
            var b, c, d, e, g;
            if (!this._callbacks)
                return this;
            for (a = a.split(i), d = [].slice.call(arguments, 1); (b = a.shift()) && (c = this._callbacks[b]); )
                e = f(c.sync, this, [b].concat(d)), g = f(c.async, this, [b].concat(d)), e() && j(g);
            return this
        }
        function f(a, b, c) {
            function d() {
                for (var d, e = 0, f = a.length; !d && f > e; e += 1)
                    d = a[e].apply(b, c) === !1;
                return!d
            }
            return d
        }
        function g() {
            var a;
            return a = window.setImmediate ? function (a) {
                setImmediate(function () {
                    a()
                })
            } : function (a) {
                setTimeout(function () {
                    a()
                }, 0)
            }
        }
        function h(a, b) {
            return a.bind ? a.bind(b) : function () {
                a.apply(b, [].slice.call(arguments, 0))
            }
        }
        var i = /\s+/, j = g();
        return{onSync: c, onAsync: b, off: d, trigger: e}
    }(), g = function (a) {
        "use strict";
        function c(a, c, d) {
            for (var e, f = [], g = 0, h = a.length; h > g; g++)
                f.push(b.escapeRegExChars(a[g]));
            return e = d ? "\\b(" + f.join("|") + ")\\b" : "(" + f.join("|") + ")", c ? new RegExp(e) : new RegExp(e, "i")
        }
        var d = {node: null, pattern: null, tagName: "strong", className: null, wordsOnly: !1, caseSensitive: !1};
        return function (e) {
            function f(b) {
                var c, d, f;
                return(c = h.exec(b.data)) && (f = a.createElement(e.tagName), e.className && (f.className = e.className), d = b.splitText(c.index), d.splitText(c[0].length), f.appendChild(d.cloneNode(!0)), b.parentNode.replaceChild(f, d)), !!c
            }
            function g(a, b) {
                for (var c, d = 3, e = 0; e < a.childNodes.length; e++)
                    c = a.childNodes[e], c.nodeType === d ? e += b(c) ? 1 : 0 : g(c, b)
            }
            var h;
            e = b.mixin({}, d, e), e.node && e.pattern && (e.pattern = b.isArray(e.pattern) ? e.pattern : [e.pattern], h = c(e.pattern, e.caseSensitive, e.wordsOnly), g(e.node, f))
        }
    }(window.document), h = function () {
        "use strict";
        function c(c) {
            var e, f, g, i, j = this;
            c = c || {}, c.input || a.error("input is missing"), e = b.bind(this._onBlur, this), f = b.bind(this._onFocus, this), g = b.bind(this._onKeydown, this), i = b.bind(this._onInput, this), this.$hint = a(c.hint), this.$input = a(c.input).on("blur.tt", e).on("focus.tt", f).on("keydown.tt", g), 0 === this.$hint.length && (this.setHint = this.getHint = this.clearHint = this.clearHintIfInvalid = b.noop), b.isMsie() ? this.$input.on("keydown.tt keypress.tt cut.tt paste.tt", function (a) {
                h[a.which || a.keyCode] || b.defer(b.bind(j._onInput, j, a))
            }) : this.$input.on("input.tt", i), this.query = this.$input.val(), this.$overflowHelper = d(this.$input)
        }
        function d(b) {
            return a('<pre aria-hidden="true"></pre>').css({position: "absolute", visibility: "hidden", whiteSpace: "pre", fontFamily: b.css("font-family"), fontSize: b.css("font-size"), fontStyle: b.css("font-style"), fontVariant: b.css("font-variant"), fontWeight: b.css("font-weight"), wordSpacing: b.css("word-spacing"), letterSpacing: b.css("letter-spacing"), textIndent: b.css("text-indent"), textRendering: b.css("text-rendering"), textTransform: b.css("text-transform")}).insertAfter(b)
        }
        function e(a, b) {
            return c.normalizeQuery(a) === c.normalizeQuery(b)
        }
        function g(a) {
            return a.altKey || a.ctrlKey || a.metaKey || a.shiftKey
        }
        var h;
        return h = {9: "tab", 27: "esc", 37: "left", 39: "right", 13: "enter", 38: "up", 40: "down"}, c.normalizeQuery = function (a) {
            return(a || "").replace(/^\s*/g, "").replace(/\s{2,}/g, " ")
        }, b.mixin(c.prototype, f, {_onBlur: function () {
                this.resetInputValue(), this.trigger("blurred")
            }, _onFocus: function () {
                this.trigger("focused")
            }, _onKeydown: function (a) {
                var b = h[a.which || a.keyCode];
                this._managePreventDefault(b, a), b && this._shouldTrigger(b, a) && this.trigger(b + "Keyed", a)
            }, _onInput: function () {
                this._checkInputValue()
            }, _managePreventDefault: function (a, b) {
                var c, d, e;
                switch (a) {
                    case"tab":
                        d = this.getHint(), e = this.getInputValue(), c = d && d !== e && !g(b);
                        break;
                    case"up":
                    case"down":
                        c = !g(b);
                        break;
                    default:
                        c = !1
                }
                c && b.preventDefault()
            }, _shouldTrigger: function (a, b) {
                var c;
                switch (a) {
                    case"tab":
                        c = !g(b);
                        break;
                    default:
                        c = !0
                }
                return c
            }, _checkInputValue: function () {
                var a, b, c;
                a = this.getInputValue(), b = e(a, this.query), c = b ? this.query.length !== a.length : !1, this.query = a, b ? c && this.trigger("whitespaceChanged", this.query) : this.trigger("queryChanged", this.query)
            }, focus: function () {
                this.$input.focus()
            }, blur: function () {
                this.$input.blur()
            }, getQuery: function () {
                return this.query
            }, setQuery: function (a) {
                this.query = a
            }, getInputValue: function () {
                return this.$input.val()
            }, setInputValue: function (a, b) {
                this.$input.val(a), b ? this.clearHint() : this._checkInputValue()
            }, resetInputValue: function () {
                this.setInputValue(this.query, !0)
            }, getHint: function () {
                return this.$hint.val()
            }, setHint: function (a) {
                this.$hint.val(a)
            }, clearHint: function () {
                this.setHint("")
            }, clearHintIfInvalid: function () {
                var a, b, c, d;
                a = this.getInputValue(), b = this.getHint(), c = a !== b && 0 === b.indexOf(a), d = "" !== a && c && !this.hasOverflow(), !d && this.clearHint()
            }, getLanguageDirection: function () {
                return(this.$input.css("direction") || "ltr").toLowerCase()
            }, hasOverflow: function () {
                var a = this.$input.width() - 2;
                return this.$overflowHelper.text(this.getInputValue()), this.$overflowHelper.width() >= a
            }, isCursorAtEnd: function () {
                var a, c, d;
                return a = this.$input.val().length, c = this.$input[0].selectionStart, b.isNumber(c) ? c === a : document.selection ? (d = document.selection.createRange(), d.moveStart("character", -a), a === d.text.length) : !0
            }, destroy: function () {
                this.$hint.off(".tt"), this.$input.off(".tt"), this.$hint = this.$input = this.$overflowHelper = null
            }}), c
    }(), i = function () {
        "use strict";
        function e(d) {
            d = d || {}, d.templates = d.templates || {}, d.source || a.error("missing source"), d.name && !j(d.name) && a.error("invalid dataset name: " + d.name), this.query = null, this.highlight = !!d.highlight, this.name = d.name || b.getUniqueId(), this.source = d.source, this.displayFn = h(d.display || d.displayKey), this.templates = i(d.templates, this.displayFn), this.$el = a(c.dataset.replace("%CLASS%", this.name))
        }
        function h(a) {
            function c(b) {
                return b[a]
            }
            return a = a || "value", b.isFunction(a) ? a : c
        }
        function i(a, c) {
            function d(a) {
                return"<p>" + c(a) + "</p>"
            }
            return{empty: a.empty && b.templatify(a.empty), header: a.header && b.templatify(a.header), footer: a.footer && b.templatify(a.footer), suggestion: a.suggestion || d}
        }
        function j(a) {
            return/^[_a-zA-Z0-9-]+$/.test(a)
        }
        var k = "ttDataset", l = "ttValue", m = "ttDatum";
        return e.extractDatasetName = function (b) {
            return a(b).data(k)
        }, e.extractValue = function (b) {
            return a(b).data(l)
        }, e.extractDatum = function (b) {
            return a(b).data(m)
        }, b.mixin(e.prototype, f, {_render: function (e, f) {
                function h() {
                    return p.templates.empty({query: e, isEmpty: !0})
                }
                function i() {
                    function h(b) {
                        var e;
                        return e = a(c.suggestion).append(p.templates.suggestion(b)).data(k, p.name).data(l, p.displayFn(b)).data(m, b), e.children().each(function () {
                            a(this).css(d.suggestionChild)
                        }), e
                    }
                    var i, j;
                    return i = a(c.suggestions).css(d.suggestions), j = b.map(f, h), i.append.apply(i, j), p.highlight && g({className: "tt-highlight", node: i[0], pattern: e}), i
                }
                function j() {
                    return p.templates.header({query: e, isEmpty: !o})
                }
                function n() {
                    return p.templates.footer({query: e, isEmpty: !o})
                }
                if (this.$el) {
                    var o, p = this;
                    this.$el.empty(), o = f && f.length, !o && this.templates.empty ? this.$el.html(h()).prepend(p.templates.header ? j() : null).append(p.templates.footer ? n() : null) : o && this.$el.html(i()).prepend(p.templates.header ? j() : null).append(p.templates.footer ? n() : null), this.trigger("rendered")
                }
            }, getRoot: function () {
                return this.$el
            }, update: function (a) {
                function b(b) {
                    c.canceled || a !== c.query || c._render(a, b)
                }
                var c = this;
                this.query = a, this.canceled = !1, this.source(a, b)
            }, cancel: function () {
                this.canceled = !0
            }, clear: function () {
                this.cancel(), this.$el.empty(), this.trigger("rendered")
            }, isEmpty: function () {
                return this.$el.is(":empty")
            }, destroy: function () {
                this.$el = null
            }}), e
    }(), j = function () {
        "use strict";
        function c(c) {
            var d, f, g, h = this;
            c = c || {}, c.menu || a.error("menu is required"), this.isOpen = !1, this.isEmpty = !0, this.datasets = b.map(c.datasets, e), d = b.bind(this._onSuggestionClick, this), f = b.bind(this._onSuggestionMouseEnter, this), g = b.bind(this._onSuggestionMouseLeave, this), this.$menu = a(c.menu).on("click.tt", ".tt-suggestion", d).on("mouseenter.tt", ".tt-suggestion", f).on("mouseleave.tt", ".tt-suggestion", g), b.each(this.datasets, function (a) {
                h.$menu.append(a.getRoot()), a.onSync("rendered", h._onRendered, h)
            })
        }
        function e(a) {
            return new i(a)
        }
        return b.mixin(c.prototype, f, {_onSuggestionClick: function (b) {
                this.trigger("suggestionClicked", a(b.currentTarget))
            }, _onSuggestionMouseEnter: function (b) {
                this._removeCursor(), this._setCursor(a(b.currentTarget), !0)
            }, _onSuggestionMouseLeave: function () {
                this._removeCursor()
            }, _onRendered: function () {
                function a(a) {
                    return a.isEmpty()
                }
                this.isEmpty = b.every(this.datasets, a), this.isEmpty ? this._hide() : this.isOpen && this._show(), this.trigger("datasetRendered")
            }, _hide: function () {
                this.$menu.hide()
            }, _show: function () {
                this.$menu.css("display", "block")
            }, _getSuggestions: function () {
                return this.$menu.find(".tt-suggestion")
            }, _getCursor: function () {
                return this.$menu.find(".tt-cursor").first()
            }, _setCursor: function (a, b) {
                a.first().addClass("tt-cursor"), !b && this.trigger("cursorMoved")
            }, _removeCursor: function () {
                this._getCursor().removeClass("tt-cursor")
            }, _moveCursor: function (a) {
                var b, c, d, e;
                if (this.isOpen) {
                    if (c = this._getCursor(), b = this._getSuggestions(), this._removeCursor(), d = b.index(c) + a, d = (d + 1) % (b.length + 1) - 1, -1 === d)
                        return void this.trigger("cursorRemoved");
                    -1 > d && (d = b.length - 1), this._setCursor(e = b.eq(d)), this._ensureVisible(e)
                }
            }, _ensureVisible: function (a) {
                var b, c, d, e;
                b = a.position().top, c = b + a.outerHeight(!0), d = this.$menu.scrollTop(), e = this.$menu.height() + parseInt(this.$menu.css("paddingTop"), 10) + parseInt(this.$menu.css("paddingBottom"), 10), 0 > b ? this.$menu.scrollTop(d + b) : c > e && this.$menu.scrollTop(d + (c - e))
            }, close: function () {
                this.isOpen && (this.isOpen = !1, this._removeCursor(), this._hide(), this.trigger("closed"))
            }, open: function () {
                this.isOpen || (this.isOpen = !0, !this.isEmpty && this._show(), this.trigger("opened"))
            }, setLanguageDirection: function (a) {
                this.$menu.css("ltr" === a ? d.ltr : d.rtl)
            }, moveCursorUp: function () {
                this._moveCursor(-1)
            }, moveCursorDown: function () {
                this._moveCursor(1)
            }, getDatumForSuggestion: function (a) {
                var b = null;
                return a.length && (b = {raw: i.extractDatum(a), value: i.extractValue(a), datasetName: i.extractDatasetName(a)}), b
            }, getDatumForCursor: function () {
                return this.getDatumForSuggestion(this._getCursor().first())
            }, getDatumForTopSuggestion: function () {
                return this.getDatumForSuggestion(this._getSuggestions().first())
            }, update: function (a) {
                function c(b) {
                    b.update(a)
                }
                b.each(this.datasets, c)
            }, empty: function () {
                function a(a) {
                    a.clear()
                }
                b.each(this.datasets, a), this.isEmpty = !0
            }, isVisible: function () {
                return this.isOpen && !this.isEmpty
            }, destroy: function () {
                function a(a) {
                    a.destroy()
                }
                this.$menu.off(".tt"), this.$menu = null, b.each(this.datasets, a)
            }}), c
    }(), k = function () {
        "use strict";
        function f(c) {
            var d, f, i;
            c = c || {}, c.input || a.error("missing input"), this.isActivated = !1, this.autoselect = !!c.autoselect, this.minLength = b.isNumber(c.minLength) ? c.minLength : 1, this.$node = g(c.input, c.withHint), d = this.$node.find(".tt-dropdown-menu"), f = this.$node.find(".tt-input"), i = this.$node.find(".tt-hint"), f.on("blur.tt", function (a) {
                var c, e, g;
                c = document.activeElement, e = d.is(c), g = d.has(c).length > 0, b.isMsie() && (e || g) && (a.preventDefault(), a.stopImmediatePropagation(), b.defer(function () {
                    f.focus()
                }))
            }), d.on("mousedown.tt", function (a) {
                a.preventDefault()
            }), this.eventBus = c.eventBus || new e({el: f}), this.dropdown = new j({menu: d, datasets: c.datasets}).onSync("suggestionClicked", this._onSuggestionClicked, this).onSync("cursorMoved", this._onCursorMoved, this).onSync("cursorRemoved", this._onCursorRemoved, this).onSync("opened", this._onOpened, this).onSync("closed", this._onClosed, this).onAsync("datasetRendered", this._onDatasetRendered, this), this.input = new h({input: f, hint: i}).onSync("focused", this._onFocused, this).onSync("blurred", this._onBlurred, this).onSync("enterKeyed", this._onEnterKeyed, this).onSync("tabKeyed", this._onTabKeyed, this).onSync("escKeyed", this._onEscKeyed, this).onSync("upKeyed", this._onUpKeyed, this).onSync("downKeyed", this._onDownKeyed, this).onSync("leftKeyed", this._onLeftKeyed, this).onSync("rightKeyed", this._onRightKeyed, this).onSync("queryChanged", this._onQueryChanged, this).onSync("whitespaceChanged", this._onWhitespaceChanged, this), this._setLanguageDirection()
        }
        function g(b, e) {
            var f, g, h, j;
            f = a(b), g = a(c.wrapper).css(d.wrapper), h = a(c.dropdown).css(d.dropdown), j = f.clone().css(d.hint).css(i(f)), j.val("").removeData().addClass("tt-hint").removeAttr("id name placeholder required").prop("readonly", !0).attr({autocomplete: "off", spellcheck: "false", tabindex: -1}), f.data(l, {dir: f.attr("dir"), autocomplete: f.attr("autocomplete"), spellcheck: f.attr("spellcheck"), style: f.attr("style")}), f.addClass("tt-input").attr({autocomplete: "off", spellcheck: !1}).css(e ? d.input : d.inputWithNoHint);
            try {
                !f.attr("dir") && f.attr("dir", "auto")
            } catch (k) {
            }
            return f.wrap(g).parent().prepend(e ? j : null).append(h)
        }
        function i(a) {
            return{backgroundAttachment: a.css("background-attachment"), backgroundClip: a.css("background-clip"), backgroundColor: a.css("background-color"), backgroundImage: a.css("background-image"), backgroundOrigin: a.css("background-origin"), backgroundPosition: a.css("background-position"), backgroundRepeat: a.css("background-repeat"), backgroundSize: a.css("background-size")}
        }
        function k(a) {
            var c = a.find(".tt-input");
            b.each(c.data(l), function (a, d) {
                b.isUndefined(a) ? c.removeAttr(d) : c.attr(d, a)
            }), c.detach().removeData(l).removeClass("tt-input").insertAfter(a), a.remove()
        }
        var l = "ttAttrs";
        return b.mixin(f.prototype, {_onSuggestionClicked: function (a, b) {
                var c;
                (c = this.dropdown.getDatumForSuggestion(b)) && this._select(c)
            }, _onCursorMoved: function () {
                var a = this.dropdown.getDatumForCursor();
                this.input.setInputValue(a.value, !0), this.eventBus.trigger("cursorchanged", a.raw, a.datasetName)
            }, _onCursorRemoved: function () {
                this.input.resetInputValue(), this._updateHint()
            }, _onDatasetRendered: function () {
                this._updateHint()
            }, _onOpened: function () {
                this._updateHint(), this.eventBus.trigger("opened")
            }, _onClosed: function () {
                this.input.clearHint(), this.eventBus.trigger("closed")
            }, _onFocused: function () {
                this.isActivated = !0, this.dropdown.open()
            }, _onBlurred: function () {
                this.isActivated = !1, this.dropdown.empty(), this.dropdown.close()
            }, _onEnterKeyed: function (a, b) {
                var c, d;
                c = this.dropdown.getDatumForCursor(), d = this.dropdown.getDatumForTopSuggestion(), c ? (this._select(c), b.preventDefault()) : this.autoselect && d && (this._select(d), b.preventDefault())
            }, _onTabKeyed: function (a, b) {
                var c;
                (c = this.dropdown.getDatumForCursor()) ? (this._select(c), b.preventDefault()) : this._autocomplete(!0)
            }, _onEscKeyed: function () {
                this.dropdown.close(), this.input.resetInputValue()
            }, _onUpKeyed: function () {
                var a = this.input.getQuery();
                this.dropdown.isEmpty && a.length >= this.minLength ? this.dropdown.update(a) : this.dropdown.moveCursorUp(), this.dropdown.open()
            }, _onDownKeyed: function () {
                var a = this.input.getQuery();
                this.dropdown.isEmpty && a.length >= this.minLength ? this.dropdown.update(a) : this.dropdown.moveCursorDown(), this.dropdown.open()
            }, _onLeftKeyed: function () {
                "rtl" === this.dir && this._autocomplete()
            }, _onRightKeyed: function () {
                "ltr" === this.dir && this._autocomplete()
            }, _onQueryChanged: function (a, b) {
                this.input.clearHintIfInvalid(), b.length >= this.minLength ? this.dropdown.update(b) : this.dropdown.empty(), this.dropdown.open(), this._setLanguageDirection()
            }, _onWhitespaceChanged: function () {
                this._updateHint(), this.dropdown.open()
            }, _setLanguageDirection: function () {
                var a;
                this.dir !== (a = this.input.getLanguageDirection()) && (this.dir = a, this.$node.css("direction", a), this.dropdown.setLanguageDirection(a))
            }, _updateHint: function () {
                var a, c, d, e, f, g;
                a = this.dropdown.getDatumForTopSuggestion(), a && this.dropdown.isVisible() && !this.input.hasOverflow() ? (c = this.input.getInputValue(), d = h.normalizeQuery(c), e = b.escapeRegExChars(d), f = new RegExp("^(?:" + e + ")(.+$)", "i"), g = f.exec(a.value), g ? this.input.setHint(c + g[1]) : this.input.clearHint()) : this.input.clearHint()
            }, _autocomplete: function (a) {
                var b, c, d, e;
                b = this.input.getHint(), c = this.input.getQuery(), d = a || this.input.isCursorAtEnd(), b && c !== b && d && (e = this.dropdown.getDatumForTopSuggestion(), e && this.input.setInputValue(e.value), this.eventBus.trigger("autocompleted", e.raw, e.datasetName))
            }, _select: function (a) {
                this.input.setQuery(a.value), this.input.setInputValue(a.value, !0), this._setLanguageDirection(), this.eventBus.trigger("selected", a.raw, a.datasetName), this.dropdown.close(), b.defer(b.bind(this.dropdown.empty, this.dropdown))
            }, open: function () {
                this.dropdown.open()
            }, close: function () {
                this.dropdown.close()
            }, setVal: function (a) {
                a = b.toStr(a), this.isActivated ? this.input.setInputValue(a) : (this.input.setQuery(a), this.input.setInputValue(a, !0)), this._setLanguageDirection()
            }, getVal: function () {
                return this.input.getQuery()
            }, destroy: function () {
                this.input.destroy(), this.dropdown.destroy(), k(this.$node), this.$node = null
            }}), f
    }();
    !function () {
        "use strict";
        var c, d, f;
        c = a.fn.typeahead, d = "ttTypeahead", f = {initialize: function (c, f) {
                function g() {
                    var g, h, i = a(this);
                    b.each(f, function (a) {
                        a.highlight = !!c.highlight
                    }), h = new k({input: i, eventBus: g = new e({el: i}), withHint: b.isUndefined(c.hint) ? !0 : !!c.hint, minLength: c.minLength, autoselect: c.autoselect, datasets: f}), i.data(d, h)
                }
                return f = b.isArray(f) ? f : [].slice.call(arguments, 1), c = c || {}, this.each(g)
            }, open: function () {
                function b() {
                    var b, c = a(this);
                    (b = c.data(d)) && b.open()
                }
                return this.each(b)
            }, close: function () {
                function b() {
                    var b, c = a(this);
                    (b = c.data(d)) && b.close()
                }
                return this.each(b)
            }, val: function (b) {
                function c() {
                    var c, e = a(this);
                    (c = e.data(d)) && c.setVal(b)
                }
                function e(a) {
                    var b, c;
                    return(b = a.data(d)) && (c = b.getVal()), c
                }
                return arguments.length ? this.each(c) : e(this.first())
            }, destroy: function () {
                function b() {
                    var b, c = a(this);
                    (b = c.data(d)) && (b.destroy(), c.removeData(d))
                }
                return this.each(b)
            }}, a.fn.typeahead = function (b) {
            var c;
            return f[b] && "initialize" !== b ? (c = this.filter(function () {
                return!!a(this).data(d)
            }), f[b].apply(c, [].slice.call(arguments, 1))) : f.initialize.apply(this, arguments)
        }, a.fn.typeahead.noConflict = function () {
            return a.fn.typeahead = c, this
        }
    }()
}(window.jQuery);