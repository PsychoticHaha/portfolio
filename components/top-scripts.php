<script id=animation-loading-script>
    const lightblue = "#0077ff",
        darkblue = "#020083",
        loadingOverlay = document.querySelector(".load-overlay-container"),
        styleTag = document.createElement("style");
    document.head.appendChild(styleTag), generateCards(), createAnimation();
    const cards = document.querySelectorAll(".animate-card");

    function generateCards() {
        for (let n = 0; n <= 5; n++) {
            let a = 10 * n > 10 ? 10 * n - 5 : 10 * n;
            loadingOverlay.innerHTML += `\n            <div class="animate-card" style="animation:scaling 2s ${a}0ms 1 forwards;">\n            <p class="inside">...</p>\n            <p class="inside2">...</p>\n            </div>\n          `
        }
    }

    function createAnimation() {
        styleTag.innerHTML = `\n          @keyframes scaling{\n          0%{transform:translate(0);}\n          20%{transform:translate(${sign()}${moveRandom()},${sign()}${moveRandom()});}\n          40%{transform:translate(${sign()}${moveRandom()},${sign()}${moveRandom()});}\n          60%{\n            transform:translate(${sign()}${moveRandom()},${sign()}${moveRandom()});\n            perspective:${1e3 * Math.random()}px;\n          }\n          80%{transform:translate(${sign()}${moveRandom()},${sign()}${moveRandom()});}\n          80%{transform:rotate(${sign()}${Math.round(10 * randomNbr())}deg);}\n          }`
    }

    function sign() {
        return Math.ceil(10 * Math.random()) > 5 ? "" : "-"
    }

    function randomNbr() {
        return "" + 100 * Math.random()
    }

    function moveRandom() {
        return `${sign()}${Math.round(10 * Math.random()) + 60}px`
    }
    cards[cards.length - 1].addEventListener("webkitAnimationEnd", (() => {
        cards.forEach((n => {
            n.style.animationName = "", setTimeout((() => {
                n.style.animationName = "scaling", createAnimation()
            }), 200)
        }))
    }))
</script>
<script>
    function hideLoaderX() {
        if (document.querySelector(".load-overlay-container")) {
            const e = document.querySelectorAll(".animate-card");
            setTimeout((() => {
                setTimeout((() => {
                    loadingOverlay.classList.add("moveUp"), setTimeout((() => {
                        loadingOverlay.style = "display:none;", loadingOverlay.remove()
                    }), 1e3)
                }), 4e3);
                const t = document.querySelectorAll(".line-overlay");
                for (let o = 0; o < t.length; o++) setTimeout((() => {
                    if (t[o].classList.add("remove"), t[o].style.animationDelay = `${o + 1}00ms`, 8 == o)
                        for (let t = 0; t < e.length; t++) setTimeout((() => {
                            e[t].classList.add("zoom"), setTimeout((() => {
                                e[t].remove()
                            }), 500)
                        }), 100);
                    setTimeout((() => {
                        t[o].remove()
                    }), 2e3), setTimeout((() => {
                        if (o == t.length - 1) {
                            const e = document.getElementById("animation-loading-script");
                            e && (e.remove(), loadingOverlay.remove())
                        }
                    }), 2e3)
                }), 2e3)
            }), 500)
        }
    }
</script>
