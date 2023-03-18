const password=document.getElementById("pass")
let username=document.getElementById("name");
let button=document.getElementById("login");


if ('session' in localStorage && localStorage.getItem('session')!="-1") {
    // Data is present in local storage
    window.location.href ="profile.html";
    console.log('Data is present in local storage');
}

submit_id=button.addEventListener("click",(e)=>{
    if((username.value=="")||(password.value=="")){
        alert("invalid");
        return
    }
    else{
    
    if ('session' in localStorage && localStorage.getItem('session')!="-1") {
        // Data is present in local storage
        window.location.href ="profile.html";
        console.log('Data is present in local storage');
    }
    else{
        
        const data={"username":username.value,"password":password.value};
        $.ajax(
            {
                url:"./php/login.php",
                method:"post",
                data:data,
                datatype:"html",
                success:function(res){
                    console.log(res)
                    res=res.split(',');
                    console.log(res[0]);
                    if(res[0]=="1"){
                        
                        
                        window.location.href ="profile.html";
                        localStorage.setItem('session',res[1]);
                    }
                    else if(res[0]=="2"){
                        alert("wrong credentials");
                    }
                    else if(res[0]=="3"){
                        alert("accound does not exists");
                    }
                    
                }
                
            }
        );
    } 
    
    
    
}

});