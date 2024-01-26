var form = document.querySelector('.formlike');



form.addEventListener('submit', async function (e) {
    e.preventDefault();
    const post_id = document.querySelector('#post_id').value

    let formData = new FormData()
    formData.append('post_id', post_id)

    fetch('./process/add_like.php', {
        method: "POST",
        body: formData
    }).then((response) => {
        return response.text()
    }).then((data) => {
        getLike()
    })

})
async function getLike(){
    let formLike = new FormData()
    const id_post = document.querySelector('#post_id').value
    formLike.append('post_id', id_post )
    const response = await fetch('./process/list_like.php',{
        method:"post",
        body: formLike
    });
    const data = await response.json();
    console.log(data);
    let spanlike = document.querySelector('#spanlikes');

    spanlike.innerHTML =data.nbLike;
    


}   

setInterval(() => {
    getLike()
}, 1000);
