let forms = document.querySelectorAll('.formlike')


forms.forEach(form => {



})


async function getLike() {
    let formLike = new FormData()
    const id_post = document.querySelector('#post_id').value
    formLike.append('post_id', id_post)
    const response = await fetch('./process/list_like.php', {
        method: "post",
        body: formLike
    });
    const data = await response.json();
    console.log(data);
    let spanlike = document.querySelector('#spanlikes');

    spanlike.innerHTML = data.nbLike;



}


setInterval(() => {
    getLike()
}, 1000);