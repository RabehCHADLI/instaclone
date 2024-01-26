var form = document.querySelector('#form_comment')
console.log(form);


form.addEventListener('submit', function (e) {

    e.preventDefault();

    let content = document.querySelector('#content_com').value
    let id = document.querySelector('#post_id').value
    console.log(content);

    let formData = new FormData()
    formData.append('post_id', id )
    formData.append('content', content)

    fetch('./process/add_comment.php', {
        method: "POST", 
        body: formData
    }).then((response)=>{
        return response.json()
    }).then((data)=>{
        document.querySelector('#content_com').value ='' 

        getComment()
    })

})

async function getComment(){
    let formMessage = new FormData()
    const id_post = document.querySelector('#post_id').value
    formMessage.append('post_id', id_post )
    const response = await fetch('./process/list_comment.php',{
        method:"post",
        body: formMessage
    });
    const data = await response.json();
    console.log(data);
    let divComment = document.querySelector('#listComment');
    divComment.innerHTML ="";
    data.forEach(post => {

        divComment.innerHTML += `
        <p class=""><span class='fw-bold'>${post.pseudo}:</span> ${post.content} <br>
         ${post.created_at}</p>
        `
    });
}

 setInterval(() => {
    getComment()
 }, 1000);