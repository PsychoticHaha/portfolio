let themeBtn = document.querySelector("header.header .right .theme-toggle-btn"), nav_links = document.querySelectorAll("nav.desktop-menu .links .link"); function animateIcon() { let e = document.querySelectorAll("header.header .right .theme-toggle-btn .svg"); e.forEach(e => { e.classList.add("off"), setTimeout(() => (e.classList.remove("off"), !0), 400) }) } function toggleTheme() {
  let e = document.getElementById("scrollbar-style"); setTimeout(() => { themeBtn.firstElementChild.classList.toggle("dark") }, 400), animateIcon(), document.body.classList.contains("dark") ? (document.body.classList.remove("dark"), document.querySelector(':root').classList.remove("dark"), e.innerHTML = `
      ::-webkit-scrollbar-thumb{
          background-color: #295bff;
          border-radius: 20px;
        }`, localStorage.setItem("theme", "light")) : (document.body.classList.add("dark"), document.querySelector(':root').classList.add("dark"), e.innerHTML = `
      ::-webkit-scrollbar-thumb{
          background-color: #0a1a52;
          border-radius: 20px;
      }`, localStorage.setItem("theme", "dark"))
};
document.addEventListener("DOMContentLoaded", () => {
  themeBtn.addEventListener("click", toggleTheme)
});
nav_links.forEach(e => {
  let t = e.innerHTML; e.innerHTML = `
    <span class="link-text">${t}</span>
    <span class="border-span"></span>`});
let descParagraph = document.querySelector(".js-changing-paragraph");
document.addEventListener("DOMContentLoaded", () => {
  let e = ["a Front-End Developer", "an UI/UX Designer", "a Web Integrator", "a React Developer"];
  descParagraph.nextElementSibling; let t = 0; function n(l, s) { s < l.length ? (descParagraph.innerHTML += l.charAt(s), s++, setTimeout(function () { n(l, s) }, 50)) : setTimeout(function () { a(l, s), t >= e.length && (t = 0) }, 1e3) } function a(l, s) { s >= 0 ? (descParagraph.innerHTML = l.substring(0, s), s--, setTimeout(function () { a(l, s) }, 50)) : (t >= e.length - 1 ? t = 0 : t++, t < e.length && setTimeout(function () { n(e[t], 0) }, 500)) } n(e[t], 0)
});

let hamburger_menu = document.querySelector(".hamburger-menu"), mobileMenu = document.querySelector(".mobile-menu"), links = mobileMenu.querySelectorAll("a"); function toggleMobileMenu() { mobileMenu.classList.toggle("show"), hamburger_menu.classList.toggle("clicked") }
function hideLoader() { let e = document.querySelector(".load-overlay-container"); if (e) { let t = document.querySelectorAll(".animate-card"); setTimeout(() => { setTimeout(() => { e.classList.add("moveUp"), setTimeout(() => { e.style = "display:none;", e.remove() }, 1e3) }, 4e3); let n = document.querySelectorAll(".line-overlay"); for (let a = 0; a < n.length; a++)setTimeout(() => { if (n[a].classList.add("remove"), n[a].style.animationDelay = `${a + 1}00ms`, 8 == a) for (let l = 0; l < t.length; l++)setTimeout(() => { t[l].classList.add("zoom"), setTimeout(() => { t[l].remove() }, 500) }, 100); setTimeout(() => { n[a].remove() }, 2e3), setTimeout(() => { if (a == n.length - 1) { let t = document.getElementById("animation-loading-script"); t && (t.remove(), e.remove()) } }, 2e3) }, 2e3) }, 500) } } hamburger_menu.addEventListener("click", () => { toggleMobileMenu() }), links.forEach(e => { e.addEventListener("click", () => { toggleMobileMenu() }) }), document.addEventListener("DOMContentLoaded", () => { hideLoader(); let e = localStorage.getItem("reaction"); if (e) { let t = document.querySelector(".reactions .icon.like"), n = document.querySelector(".reactions .icon.dislike"), a = document.querySelector(".reactions .icon.love"); "like" == e ? t.classList.add("clicked") : "love" == e ? a.classList.add("clicked") : n.classList.add("dislike") } let l = document.querySelector(".theme-toggle-btn"), s = localStorage.getItem("theme"), o = document.body; "dark" == s ? o.classList.add("dark") : o.classList.remove("dark"), "dark" !== s ? l.firstElementChild.classList.add("dark") : l.firstElementChild.classList.remove("dark"); let r = document.querySelectorAll(".my-works .works-container .links"); r.forEach(e => { let t = e.querySelectorAll("a"); t.forEach(e => { e.addEventListener("focus", () => { e.parentElement.classList.add("show") }), e.addEventListener("focusout", () => { e.parentElement.classList.remove("show") }) }) }) }); let customCursor = document.querySelector(".mouse-cursor"); document.addEventListener("mousemove", e => { let t = { width: customCursor.offsetWidth, height: customCursor.offsetHeight }, n = e.clientX - t.width / 2, a = e.clientY - t.height / 2; customCursor.style.left = `${n}px`, customCursor.style.top = `${a}px` }); let readMoreAboutBtn = document.getElementById("read-more-about-me"), aboutMeParagraph = document.getElementById("about-paragraph");

function toggleText() {
  aboutMeParagraph.classList.contains("less") ? (aboutMeParagraph.classList.remove("less"), readMoreAboutBtn.innerHTML = "Read less", aboutMeParagraph.innerHTML = `
    <p class="full-text">
      RAF, a talented self-taught web developer who embarked on his coding journey in 2016. Despite taking a
      hiatus
      between 2018 and 2022, his passion for programming and development has remained unwavering. Always on the
      lookout for fresh challenges, RAF specializes in frontend development with a mastery of React JS.
    </p>
    <p class="full-text">
      In the dynamic world of web development, RAF stands out as an individual who not only embraces challenges
      but thrives on them. His journey showcases resilience and a continuous pursuit of excellence, evident in
      his
      commitment to honing his skills.
    </p>
    <p>
      P.S : My initials, RAF, stand for Ramalandimanana Antso Fanasina.
    </p>
    <div class="source">--- *** ---</div>`) : (aboutMeParagraph.classList.add("less"), readMoreAboutBtn.innerHTML = "Read more", aboutMeParagraph.innerHTML = `
    <p class="full-text">
      RAF, a talented self-taught web developer who ...
    </p>`)
};
document.addEventListener("DOMContentLoaded", () => { readMoreAboutBtn.addEventListener("click", toggleText) }), document.addEventListener("DOMContentLoaded", function () { let e = document.querySelectorAll("section"), t = document.querySelectorAll("nav .links a"), n = document.querySelector("main"); n.addEventListener("scroll", function () { let a = ""; e.forEach(function (e) { let t = e.offsetTop - 10, l = t + e.clientHeight; n.scrollTop >= t && n.scrollTop < l && (a = "#" + e.id) }), t.forEach(function (e) { e.classList.remove("active"), (e.getAttribute("href") === a || e.getAttribute("data-scroll") === a) && e.classList.add("active") }) }) }); let contactForm = document.getElementById("contact-form"), sendBtn = document.getElementById("send-message-btn"), fullnameInput = document.getElementById("fullname"), emailInput = document.getElementById("email"), messageInput = document.getElementById("message"), popupDiv = document.querySelector(".popup-message"), closePopupBtn = document.querySelector(".close-popup-btn"); import { messageEndpoint as e } from "./endpoints.js"; function checkMessageAndEmail() { let e = messageInput.value.trim(), t = emailInput.value; return !!e && !!t && !(e.length < 6) } function showPopup(e) { popupDiv.classList.add(e), setTimeout(() => { popupDiv.classList.remove(e) }, 2500) } function closePopup() { popupDiv.classList.contains("success") ? popupDiv.classList.remove("success") : popupDiv.classList.contains("error") && popupDiv.classList.remove("error") } contactForm.addEventListener("submit", t => { t.preventDefault(); let n = fullnameInput.value, a = messageInput.value.trim(), l = emailInput.value, s = new FormData; s.append("fullname", n), s.append("email", l), s.append("message", a), checkMessageAndEmail() ? fetch(e, { method: "POST", body: s }).then(e => e.json()).then(e => { "sent" == e ? (popupDiv.firstElementChild.innerHTML = "Thanks for your message !", showPopup("success"), fullnameInput.value = "", messageInput.value = "", emailInput.value = "") : (popupDiv.firstElementChild.innerHTML = "Sorry, cannot perform the task.", showPopup("error")) }) : (popupDiv.firstElementChild.innerHTML = "Please fill the content !", showPopup("error")) }), closePopupBtn.addEventListener("click", closePopup), function (e, t) { (function e(t, n, a, l) { var s = !!(t.Worker && t.Blob && t.Promise && t.OffscreenCanvas && t.OffscreenCanvasRenderingContext2D && t.HTMLCanvasElement && t.HTMLCanvasElement.prototype.transferControlToOffscreen && t.URL && t.URL.createObjectURL), o = "function" == typeof Path2D && "function" == typeof DOMMatrix, r = function () { if (!t.OffscreenCanvas) return !1; var e = new OffscreenCanvas(1, 1), n = e.getContext("2d"); n.fillRect(0, 0, 1, 1); var a = e.transferToImageBitmap(); try { n.createPattern(a, "no-repeat") } catch (l) { return !1 } return !0 }(); function c() { } function d(e) { var a = n.exports.Promise, l = void 0 !== a ? a : t.Promise; return "function" == typeof l ? new l(e) : (e(c, c), null) } var u, m, f, v, p, h, g, y, $, b, k, L = (u = r, m = new Map, { transform: function (e) { if (u) return e; if (m.has(e)) return m.get(e); var t = new OffscreenCanvas(e.width, e.height); return t.getContext("2d").drawImage(e, 0, 0), m.set(e, t), t }, clear: function () { m.clear() } }), w = (p = Math.floor(1e3 / 60), h = {}, g = 0, "function" == typeof requestAnimationFrame && "function" == typeof cancelAnimationFrame ? (f = function (e) { var t = Math.random(); return h[t] = requestAnimationFrame(function n(a) { g === a || g + p - 1 < a ? (g = a, delete h[t], e()) : h[t] = requestAnimationFrame(n) }), t }, v = function (e) { h[e] && cancelAnimationFrame(h[e]) }) : (f = function (e) { return setTimeout(e, p) }, v = function (e) { return clearTimeout(e) }), { frame: f, cancel: v }), x = (b = {}, function () { if (y) return y; if (!a && s) { var t = ["var CONFETTI, SIZE = {}, module = {};", "(" + e.toString() + ")(this, module, true, SIZE);", "onmessage = function(msg) {", "  if (msg.data.options) {", "    CONFETTI(msg.data.options).then(function () {", "      if (msg.data.callback) {", "        postMessage({ callback: msg.data.callback });", "      }", "    });", "  } else if (msg.data.reset) {", "    CONFETTI && CONFETTI.reset();", "  } else if (msg.data.resize) {", "    SIZE.width = msg.data.resize.width;", "    SIZE.height = msg.data.resize.height;", "  } else if (msg.data.canvas) {", "    SIZE.width = msg.data.canvas.width;", "    SIZE.height = msg.data.canvas.height;", "    CONFETTI = module.exports.create(msg.data.canvas);", "  }", "}"].join("\n"); try { y = new Worker(URL.createObjectURL(new Blob([t]))) } catch (n) { return "function" == typeof console.warn && console.warn("\uD83C\uDF8A Could not load worker", n), null } !function (e) { function t(t, n) { e.postMessage({ options: t || {}, callback: n }) } e.init = function (t) { var n = t.transferControlToOffscreen(); e.postMessage({ canvas: n }, [n]) }, e.fire = function (n, a, l) { if ($) return t(n, null), $; var s = Math.random().toString(36).slice(2); return $ = d(function (a) { function o(t) { t.data.callback === s && (delete b[s], e.removeEventListener("message", o), $ = null, L.clear(), l(), a()) } e.addEventListener("message", o), t(n, s), b[s] = o.bind(null, { data: { callback: s } }) }) }, e.reset = function () { for (var t in e.postMessage({ reset: !0 }), b) b[t](), delete b[t] } }(y) } return y }), E = { particleCount: 50, angle: 90, spread: 45, startVelocity: 45, decay: .9, gravity: 1, drift: 0, ticks: 200, x: .5, y: .5, shapes: ["square", "circle"], zIndex: 100, colors: ["#26ccff", "#a25afd", "#ff5e7e", "#88ff5a", "#fcff42", "#ffa62d", "#ff36ff"], disableForReducedMotion: !1, scalar: 1 }; function T(e, t, n) { var a, l; return a = e && null != e[t] ? e[t] : E[t], (l = n) ? l(a) : a } function S(e) { return e < 0 ? 0 : Math.floor(e) } function B(e) { return parseInt(e, 16) } function C(e) { return e.map(I) } function I(e) { var t = String(e).replace(/[^0-9a-f]/gi, ""); return t.length < 6 && (t = t[0] + t[0] + t[1] + t[1] + t[2] + t[2]), { r: B(t.substring(0, 2)), g: B(t.substring(2, 4)), b: B(t.substring(4, 6)) } } function _(e) { e.width = document.documentElement.clientWidth, e.height = document.documentElement.clientHeight } function M(e) { var t = e.getBoundingClientRect(); e.width = t.width, e.height = t.height } function P(e, n) { var r, c = !e, u = !!T(n || {}, "resize"), m = !1, f = T(n, "disableForReducedMotion", Boolean), v = s && T(n || {}, "useWorker") ? x() : null, p = c ? _ : M, h = !(!e || !v) && !!e.__confetti_initialized, g = "function" == typeof matchMedia && matchMedia("(prefers-reduced-motion)").matches; function y(n) { var s, y, $ = f || T(n, "disableForReducedMotion", Boolean), b = T(n, "zIndex", Number); if ($ && g) return d(function (e) { e() }); c && r ? e = r.canvas : c && !e && (e = (s = b, (y = document.createElement("canvas")).style.position = "fixed", y.style.top = "0px", y.style.left = "0px", y.style.pointerEvents = "none", y.style.zIndex = s, y), document.body.appendChild(e)), u && !h && p(e); var k = { width: e.width, height: e.height }; function x() { if (v) { var t = { getBoundingClientRect: function () { if (!c) return e.getBoundingClientRect() } }; return p(t), void v.postMessage({ resize: { width: t.width, height: t.height } }) } k.width = k.height = null } function E() { r = null, u && (m = !1, t.removeEventListener("resize", x)), c && e && (document.body.removeChild(e), e = null, h = !1) } return v && !h && v.init(e), h = !0, v && (e.__confetti_initialized = !0), u && !m && (m = !0, t.addEventListener("resize", x, !1)), v ? v.fire(n, k, E) : function t(n, s, c) { for (var u, m, f, v, h, g, y, $, b, k, x, E, B, I, _, M, P, A = T(n, "particleCount", S), R = T(n, "angle", Number), D = T(n, "spread", Number), F = T(n, "startVelocity", Number), q = T(n, "decay", Number), O = T(n, "gravity", Number), H = T(n, "drift", Number), z = T(n, "colors", C), W = T(n, "ticks", Number), j = T(n, "shapes"), U = T(n, "scalar"), N = !!T(n, "flat"), X = (x = n, (E = T(x, "origin", Object)).x = T(E, "x", Number), E.y = T(E, "y", Number), E), V = A, Y = [], Z = e.width * X.x, G = e.height * X.y; V--;)Y.push((B = { x: Z, y: G, angle: R, spread: D, startVelocity: F, color: z[V % z.length], shape: j[M = 0, Math.floor(Math.random() * ((P = j.length) - M)) + M], ticks: W, decay: q, gravity: O, drift: H, scalar: U, flat: N }, I = void 0, _ = void 0, I = B.angle * (Math.PI / 180), _ = B.spread * (Math.PI / 180), { x: B.x, y: B.y, wobble: 10 * Math.random(), wobbleSpeed: Math.min(.11, .1 * Math.random() + .05), velocity: .5 * B.startVelocity + Math.random() * B.startVelocity, angle2D: -I + (.5 * _ - Math.random() * _), tiltAngle: (.5 * Math.random() + .25) * Math.PI, color: B.color, shape: B.shape, tick: 0, totalTicks: B.ticks, decay: B.decay, drift: B.drift, random: Math.random() + 2, tiltSin: 0, tiltCos: 0, wobbleX: 0, wobbleY: 0, gravity: 3 * B.gravity, ovalScalar: .6, scalar: B.scalar, flat: B.flat })); return r ? r.addFettis(Y) : (r = (u = e, m = Y, f = p, v = s, h = c, $ = m.slice(), b = u.getContext("2d"), k = d(function (e) { function t() { g = y = null, b.clearRect(0, 0, v.width, v.height), L.clear(), h(), e() } g = w.frame(function e() { a && (v.width !== l.width || v.height !== l.height) && (v.width = u.width = l.width, v.height = u.height = l.height), v.width || v.height || (f(u), v.width = u.width, v.height = u.height), b.clearRect(0, 0, v.width, v.height), ($ = $.filter(function (e) { return function e(t, n) { n.x += Math.cos(n.angle2D) * n.velocity + n.drift, n.y += Math.sin(n.angle2D) * n.velocity + n.gravity, n.velocity *= n.decay, n.flat ? (n.wobble = 0, n.wobbleX = n.x + 10 * n.scalar, n.wobbleY = n.y + 10 * n.scalar, n.tiltSin = 0, n.tiltCos = 0, n.random = 1) : (n.wobble += n.wobbleSpeed, n.wobbleX = n.x + 10 * n.scalar * Math.cos(n.wobble), n.wobbleY = n.y + 10 * n.scalar * Math.sin(n.wobble), n.tiltAngle += .1, n.tiltSin = Math.sin(n.tiltAngle), n.tiltCos = Math.cos(n.tiltAngle), n.random = Math.random() + 2); var a, l, s, r, c, d, u, m, f, v, p, h, g, y, $, b, k, w = n.tick++ / n.totalTicks, x = n.x + n.random * n.tiltCos, E = n.y + n.random * n.tiltSin, T = n.wobbleX + n.random * n.tiltCos, S = n.wobbleY + n.random * n.tiltSin; if (t.fillStyle = "rgba(" + n.color.r + ", " + n.color.g + ", " + n.color.b + ", " + (1 - w) + ")", t.beginPath(), o && "path" === n.shape.type && "string" == typeof n.shape.path && Array.isArray(n.shape.matrix)) t.fill((a = n.shape.path, l = n.shape.matrix, s = n.x, r = n.y, c = .1 * Math.abs(T - x), d = .1 * Math.abs(S - E), u = Math.PI / 10 * n.wobble, m = new Path2D(a), (f = new Path2D).addPath(m, new DOMMatrix(l)), (v = new Path2D).addPath(f, new DOMMatrix([Math.cos(u) * c, Math.sin(u) * c, -Math.sin(u) * d, Math.cos(u) * d, s, r])), v)); else if ("bitmap" === n.shape.type) { var B = Math.PI / 10 * n.wobble, C = .1 * Math.abs(T - x), I = .1 * Math.abs(S - E), _ = n.shape.bitmap.width * n.scalar, M = n.shape.bitmap.height * n.scalar, P = new DOMMatrix([Math.cos(B) * C, Math.sin(B) * C, -Math.sin(B) * I, Math.cos(B) * I, n.x, n.y]); P.multiplySelf(new DOMMatrix(n.shape.matrix)); var A = t.createPattern(L.transform(n.shape.bitmap), "no-repeat"); A.setTransform(P), t.globalAlpha = 1 - w, t.fillStyle = A, t.fillRect(n.x - _ / 2, n.y - M / 2, _, M), t.globalAlpha = 1 } else if ("circle" === n.shape) { t.ellipse ? t.ellipse(n.x, n.y, Math.abs(T - x) * n.ovalScalar, Math.abs(S - E) * n.ovalScalar, Math.PI / 10 * n.wobble, 0, 2 * Math.PI) : (p = t, h = n.x, g = n.y, y = Math.abs(T - x) * n.ovalScalar, $ = Math.abs(S - E) * n.ovalScalar, b = Math.PI / 10 * n.wobble, k = 2 * Math.PI, p.save(), p.translate(h, g), p.rotate(b), p.scale(y, $), p.arc(0, 0, 1, 0, k, void 0), p.restore()) } else if ("star" === n.shape) for (var R = Math.PI / 2 * 3, D = 4 * n.scalar, F = 8 * n.scalar, q = n.x, O = n.y, H = 5, z = Math.PI / H; H--;)q = n.x + Math.cos(R) * F, O = n.y + Math.sin(R) * F, t.lineTo(q, O), R += z, q = n.x + Math.cos(R) * D, O = n.y + Math.sin(R) * D, t.lineTo(q, O), R += z; else t.moveTo(Math.floor(n.x), Math.floor(n.y)), t.lineTo(Math.floor(n.wobbleX), Math.floor(E)), t.lineTo(Math.floor(T), Math.floor(S)), t.lineTo(Math.floor(x), Math.floor(n.wobbleY)); return t.closePath(), t.fill(), n.tick < n.totalTicks }(b, e) })).length ? g = w.frame(e) : t() }), y = t }), { addFettis: function (e) { return $ = $.concat(e), k }, canvas: u, promise: k, reset: function () { g && w.cancel(g), y && y() } })).promise }(n, k, E) } return y.reset = function () { v && v.reset(), r && r.reset() }, y } function A() { return k || (k = P(null, { useWorker: !0, resize: !0 })), k } n.exports = function () { return A().apply(this, arguments) }, n.exports.reset = function () { A().reset() }, n.exports.create = P, n.exports.shapeFromPath = function (e) { if (!o) throw Error("path confetti are not supported in this browser"); "string" == typeof e ? a = e : (a = e.path, l = e.matrix); var t = new Path2D(a), n = document.createElement("canvas").getContext("2d"); if (!l) { for (var a, l, s, r, c = 1e3, d = c, u = c, m = 0, f = 0, v = 0; v < c; v += 2)for (var p = 0; p < c; p += 2)n.isPointInPath(t, v, p, "nonzero") && (d = Math.min(d, v), u = Math.min(u, p), m = Math.max(m, v), f = Math.max(f, p)); var h = Math.min(10 / (s = m - d), 10 / (r = f - u)); l = [h, 0, 0, h, -Math.round(s / 2 + d) * h, -Math.round(r / 2 + u) * h] } return { type: "path", path: a, matrix: l } }, n.exports.shapeFromText = function (e) { var t, n = 1, a = "#000000", l = '"Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji", "EmojiOne Color", "Android Emoji", "Twemoji Mozilla", "system emoji", sans-serif'; "string" == typeof e ? t = e : (t = e.text, n = "scalar" in e ? e.scalar : n, l = "fontFamily" in e ? e.fontFamily : l, a = "color" in e ? e.color : a); var s = 10 * n, o = s + "px " + l, r = new OffscreenCanvas(s, s), c = r.getContext("2d"); c.font = o; var d = c.measureText(t), u = Math.ceil(d.actualBoundingBoxRight + d.actualBoundingBoxLeft), m = Math.ceil(d.actualBoundingBoxAscent + d.actualBoundingBoxDescent), f = d.actualBoundingBoxLeft + 2, v = d.actualBoundingBoxAscent + 2; u += 4, m += 4, (c = (r = new OffscreenCanvas(u, m)).getContext("2d")).font = o, c.fillStyle = a, c.fillText(t, f, v); var p = 1 / n; return { type: "bitmap", bitmap: r.transferToImageBitmap(), matrix: [p, 0, 0, p, -u * p / 2, -m * p / 2] } } })(function () { return void 0 !== e ? e : "undefined" != typeof self ? self : this || {} }(), t, !1), e.confetti = t.exports }(window, {}); let likeBtn = document.querySelector(".reactions .icon.like"), dislikeBtn = document.querySelector(".reactions .icon.dislike"), loveBtn = document.querySelector(".reactions .icon.love"), container = likeBtn.parentElement.parentElement, tellMeWhyForm = document.querySelector(".tell-me-why"), closeBtn_TellMeWhyForm = document.querySelector(".tell-me-why .close"); import { reactionBackendPoint as t } from "./endpoints.js"; function addReaction(e) { let n = createCanvas(container), a = confetti.create(n); if ("like" == e) localStorage.setItem("reaction", "like"), container.appendChild(n), a({ startVelocity: 30, origin: { x: .5, y: 1 } }).then(() => { container.removeChild(n) }), likeBtn.classList.add("animate"), setTimeout(() => { likeBtn.classList.replace("animate", "clicked") }, 350), dislikeBtn.classList.remove("clicked"), loveBtn.classList.remove("clicked"); else if ("dislike" == e) localStorage.setItem("reaction", "dislike"), container.appendChild(n), dislikeBtn.classList.add("sad"), dislikeBtn.innerHTML = "\uD83D\uDE2D", setTimeout(() => { dislikeBtn.innerHTML = "", dislikeBtn.classList.remove("sad"), dislikeBtn.classList.add("clicked"), dislikeBtn.classList.add("animate"), setTimeout(() => { dislikeBtn.classList.remove("animate") }, 350), setTimeout(() => { tellMeWhyForm.classList.add("show") }, 400) }, 1e3), likeBtn.classList.remove("clicked"), loveBtn.classList.remove("clicked"); else { localStorage.setItem("reaction", "love"), loveBtn.classList.add("animate"); let l = localStorage.getItem("reaction"); if (!l) { let s = new FormData; s.append("reaction", JSON.stringify(l)), s.append("date", new Date().toISOString()), fetch(t, { method: "POST", body: s }).then(e => e.json()).then(e => console.log(e)) } setTimeout(() => { loveBtn.classList.replace("animate", "clicked") }, 350), confetti({ spread: 180 }); var o = Date.now() + 1e3; !function e() { confetti({ particleCount: 7, angle: 60, spread: 55, origin: { x: 0 } }), confetti({ particleCount: 7, angle: 120, spread: 55, origin: { x: 1 } }), Date.now() < o && requestAnimationFrame(e) }(), likeBtn.classList.remove("clicked"), dislikeBtn.classList.remove("clicked") } } function removeReaction(e) { } function createCanvas(e) { let t = document.createElement("canvas"); return t.width = e.offsetWidth, t.height = e.offsetHeight, t.style.position = "absolute", t.style.top = "0", t.style.left = "0", t.style.zIndex = "5465456478", t.style.pointerEvents = "none", t } function closeTellMeWhyForm() { tellMeWhyForm.classList.remove("show") } closeBtn_TellMeWhyForm.addEventListener("click", closeTellMeWhyForm), loveBtn.addEventListener("click", () => { loveBtn.classList.contains("clicked") ? removeReaction(loveBtn) : addReaction("love") }), likeBtn.addEventListener("click", () => { likeBtn.classList.contains("clicked") ? removeReaction(likeBtn) : addReaction("like") }), dislikeBtn.addEventListener("click", () => { dislikeBtn.classList.contains("clicked") ? removeReaction(dislikeBtn) : addReaction("dislike") });
let elements =
  [`<div class="element element1"><div class="icon mobile"></div><div class="text">Mobile-friendy Design</div></div>`, `<div class="element element2"><div class="icon rocket"></div><div class="text">Performance Optimization</div></div>`,
  `<div class="element element3"><div class="icon phone-pc-link"></div><div class="text">Responsive Design</div></div>`, `
  <div class="element element4">
    <div class="icon structure"></div>
    <div class="text">Well Structured Codes and Folders</div>
  </div>          
  `, `
  <div class="element element5">
    <div class="icon search-engin"></div>
    <div class="text">SEO Optimization</div>
  </div> 
  `, `
  <div class="element element6">
    <div class="icon bug"></div>
    <div class="text">Test and debugging</div>
  </div>`, `  
  <div class="element element7">
    <div class="icon users"></div>
    <div class="text">User-Centered Design</div>
  </div> 
  `], content = `
  <div class="overlay left"></div>
  <div class="overlay right"></div>
    <div class="element">
        <div class="icon mobile"></div>
        <div class="text">Mobile-friendy Design</div>
      </div>
      <div class="element ">
        <div class="icon rocket"></div>
        <div class="text">Performance Optimization</div>
      </div>
      <div class="element">
        <div class="icon phone-pc-link"></div>
        <div class="text">Responsive Design</div>
      </div>         
      <div class="element">
        <div class="icon structure"></div>
        <div class="text">Well Structured Codes and Folders</div>
      </div>          
      <div class="element">
        <div class="icon search-engin"></div>
        <div class="text">SEO Optimization</div>
      </div> 
      <div class="element">
        <div class="icon bug"></div>
        <div class="text">Test and debugging</div>
      </div>  
      <div class="element">
        <div class="icon users"></div>
        <div class="text">User-Centered Design</div>
      </div> 
  `, icons = ["mobile", "rocket", "phone-pc-link", "structure", "search-engin", "bug", "users"], texts = ["Mobile-friendy Design", "Performance Optimization", "Responsive Design", "Well Structured Codes and Folders", "SEO Optimization", "Test and debugging", "User-Centered Design"], scrollingContainer = document.querySelector(".scrolling-content"), TransformStyleTag = document.createElement("style"); TransformStyleTag.id = "transform", document.head.appendChild(TransformStyleTag); let i = 0, TRANSLATE_ANIMATION_END = 2500, actualTranslate = 0, totalGap = 15; setInterval(() => {
  let e = document.querySelectorAll(".scrolling-content .element"), t = e[i], n = t.clientWidth; actualTranslate || (actualTranslate = n + totalGap); let a = document.getElementById("transform"); a.innerHTML = `
    section.why-us .box .scrolling-content .element{
      transform : translate(-${actualTranslate}px) !important;
    }`, actualTranslate += n + totalGap; let l = t.cloneNode(!0); scrollingContainer.appendChild(l), ++i > 24 && (a.innerHTML = `
    section.why-us .box .scrolling-content .element{
      transform : translate(0px) !important;
      transition: 0;
    }`, i = 0, actualTranslate = 0, scrollingContainer.innerHTML = content)
}, 2500);