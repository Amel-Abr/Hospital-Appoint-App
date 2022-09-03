const logContent = document.querySelector(".logContent"),
      pwShowHide = document.querySelectorAll(".showHidePw"),
      pwFields = document.querySelectorAll(".password"),
      signUp = document.querySelector(".signup-link"),
      login = document.querySelector(".login-link");



pwShowHide.forEach(eyeIcon =>{
    eyeIcon.addEventListener("click", ()=>{
        pwFields.forEach(pwField =>{
            if(pwField.type ==="password"){
                pwField.type = "text";

                pwShowHide.forEach(icon =>{
                icon.classList.replace("fa-eye-slash", "fa-eye");
                })
            }else{
                pwField.type = "password";
                pwShowHide.forEach(icon =>{
                icon.classList.replace("fa-eye",
                    "fa-eye-slash");
            })




         }
        })
    })
})




signUp.addEventListener("click", ( )=>{
    logContent.classList.add("active");
});
login.addEventListener("click", ()=>{
    logContent.classList.remove("active");
})


// var modal = document.getElementById("addDoctor");

// // Get the button that opens the modal
// var btn = document.getElementById("Btn");

// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// // When the user clicks the button, open the modal 
// btn.onclick = function() {
//   modal.style.display = "block";
// }

// // When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//   modal.style.display = "none";
// }

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }