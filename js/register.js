const password=document.getElementById("pass")
const confirm_password=document.getElementById("pass2")
let username=document.getElementById("name");
var button=document.getElementById("signup");


button.addEventListener("click",(e)=>{
    
    if(password.value!=confirm_password.value){
        alert("passowrd and confirm password should be same");
        return
    }
    if((username.value=="")||(password.value==""||confirm_password.value=="")){
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
            datatype:"text",
            success:function(res){
                
                res=res.toString();
                console.log(res,res==1,res==0);
                if(res==1){
                    window.location.href="login.html";
                }
                
                else if(res==0){
                    alert("user already exits");
                }
            }
            
        }
    );
        
    //console.log(data,password.value!=confirm_password.value);
}

});