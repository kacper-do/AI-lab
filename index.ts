
const styles: Record<string, string> = {
    Styl1: 'dist/style/style1.css',
    Styl2: 'dist/style/style2.css',
    Styl3: 'dist/style/style3.css',
    Styl4: 'dist/style/style4.css',
};


let currentStyle = 'Styl1';


const dynamicStyleLink = document.createElement('link');
dynamicStyleLink.rel = 'stylesheet';
dynamicStyleLink.href = styles[currentStyle];
document.head.appendChild(dynamicStyleLink);

const styleLinksContainer = document.createElement('nav');
document.body.prepend(styleLinksContainer);
function generateStyleLinks() {
    styleLinksContainer.innerHTML = '';

    for (const styleName in styles) {
        const link = document.createElement('a');
        link.textContent = styleName;
        link.href = '#';
        link.dataset.style = styleName;
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const styleKey = (event.target as HTMLAnchorElement).dataset.style;
            if (styleKey) {
                changeStyle(styleKey);
            }
        });
        styleLinksContainer.appendChild(link);
    }
}

function changeStyle(styleName: string) {
    if (!styles[styleName]) return;

    currentStyle = styleName;
    dynamicStyleLink.href = styles[styleName];

    console.log(`Styl zmieniony na: ${styleName}`);
}

document.addEventListener('DOMContentLoaded', generateStyleLinks);
