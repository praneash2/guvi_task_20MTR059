const password=document.getElementById("pass")
let username=document.getElementById("name");
let button=document.getElementById("signup");


submit_id=button.addEventListener("click",(e)=>{
    if((username.value=="")||(password.value=="")){
        alert("invalid");
        return
    }
    else{
    const data={"username":username.value,"password":password.value};
    $.ajax(
        {
            url:"./php/register.php",
            method:"post",
            data:data,
            datatype:"html",
            success:function(res){
                console.log(res);
            }
            
        }
    );
    
    console.log(data);
}

});