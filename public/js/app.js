const isKonami=localStorage.getItem("konami");let isEnabled=isKonami;const konami=["ArrowUp","ArrowUp","ArrowDown","ArrowDown","ArrowLeft","ArrowRight","ArrowLeft","ArrowRight","b","a"];let currentKonami=[...konami];const enableKonami=()=>{currentKonami=[...konami],document.querySelectorAll("body").forEach(o=>{o.classList.toggle("konami")})};document.addEventListener("keydown",o=>{let e=o.key.toLocaleLowerCase();currentKonami[0].toLocaleLowerCase()==e?currentKonami.shift():currentKonami=[...konami],0==currentKonami.length&&(enableKonami(),isEnabled?localStorage.removeItem("konami"):localStorage.setItem("konami",!0))}),isKonami&&enableKonami();
