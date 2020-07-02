//nav scroll snap
window.addEventListener('scroll', () => {
    const scrolled = window.scrollY;
    const btNav = document.querySelector('.bt-nav');
    const topNav = document.querySelector('.top-nav');
    if (scrolled >= 25) {
        topNav.style.display = 'none';
    } else {
        topNav.style.display = 'block';
    }
})

//make category search to appear on search click
const searchresult = document.querySelectorAll('.searchresult');
const searchInput = document.querySelectorAll('#searchInput');
let i;
for (i = 0; i < searchInput.length; i++) {
    searchInput[i].addEventListener('click', () => {
        searchresult.innerHTML = `<p>hello</p>`;

    })
}

//mobile search popup
const mSearch = document.querySelector('.mobile-search');
mSearch.addEventListener('click', () => {
    document.querySelector('.form-bg').style.display = 'block';
})
document.querySelector('.cancelsearch').addEventListener('click', () => {
    document.querySelector('.form-bg').style.display = 'none';

})








//const postD = document.querySelectorAll(".post-desc");
//let b;
//for (b = 0; b < postD.length; b++) {
//
//    postD[b].innerText = postD[b].innerText.substring(0, 100) + " " + "...";
//}
//
//
//        const bioMore = document.querySelector('#see-more-bio');
//        const bioLength = bio.innerText.length;
//
//        if(bio.innerText.length > 100) {
//        function bioText() {
//            bio.oldText = bio.innerText;
//
//            bio.innerText = bio.innerText.substring(0, 100) + "...";
//            bio.innerHTML += `<span onclick='addLength()' id='see-more-bio'>See More</span>`;
//        }
//         function addLength() {
//            bio.innerText = bio.oldText;
//            bio.innerHTML += "&nbsp;" + `<span onclick='bioText()' id='see-less-bio'>See Less</span>`;
//            document.getElementById('see-less-bio').addEventListener('click', () => {
//                document.getElementById('see-less-bio').style.display = 'none';
//            })
//
//        }   
//
//        }
//        bioText();