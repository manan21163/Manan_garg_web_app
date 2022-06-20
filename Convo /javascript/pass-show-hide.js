const pswrdField = document.querySelector(".form input[type='pass']"),
toggleIcon = document.querySelector(".form .field i");

toggleIcon.onclick = () =>{
  if(pswrdField.type === "pass"){
    pswrdField.type = "text";
    toggleIcon.classList.add("active");
  }else{
    pswrdField.type = "pass";
    toggleIcon.classList.remove("active");
  }
}
