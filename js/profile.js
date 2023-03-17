
let check_box=document.getElementById("check");
let edit_box=document.getElementById("edit_box");
let show_box=document.getElementById("show_box");
let logout=document.getElementById("logout");

let Name=document.getElementById("name");
let email=document.getElementById("email");
let age=document.getElementById("age");
let college=document.getElementById("college");
let department=document.getElementById("department");
let button=document.getElementById("sumbit");

//edit should be none by default
edit_box.style.display="none";

user_ID="-1"
if("session" in localStorage && localStorage.getItem("session")!="-1"){
    user_ID=localStorage.getItem("session").toString();
    user_ID=user_ID.slice(1,user_ID.length-1)
}
console.log( user_ID);

logout.addEventListener("click",(e)=>{
    localStorage.setItem("session","-1");
    window.location.href="login.html";
});

button.addEventListener("click",(e)=>{
    if((Name.value=="")||(email.value=="")||(age.value=="")||(college.value=="")||(department.value=="")){
        alert("enter all values");
        return
    }
    else if((Name.value=="")&&(email.value=="")&&(age.value=="")&&(college.value=="")&&(department.value=="")){
    const data={"check":"1","name":Name.value,"email":email.value,"age":age.value,"college":college.value,"department":department.value};
    $.ajax(
        {
            url:"./php/profile.php",
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
else{
    update_data_in_server(user_ID);
    }

});


let show_name=document.getElementById("show_name");
let show_email=document.getElementById("show_email");
let show_age=document.getElementById("show_age");
let show_college=document.getElementById("show_college");
let show_department=document.getElementById("show_department");
let show_button=document.getElementById("show_sumbit");

function retreive_from_server(ID,box_number){
    let  data={"check":"2","id":ID};
        
    $.ajax(
            {
                url:"./php/profile.php",
                method:"post",
                data:data,
                datatype:"JSON",
                success:function(res){
                    let temp=(JSON.parse(res)[0]);
                    if(box_number=="1"){ // if box_number is 1 then edit_box
                    show_name.innerText=temp["name"];
                    show_email.innerText=temp["email"];
                    show_age.innerText=temp["age"];
                    show_college.innerText=temp["college"];
                    show_department.innerText=temp["department"];
                    }
                    else if(box_number=="0"){
                        Name.value=temp["name"];
                        email.value=temp["email"];
                        age.value=temp["age"];
                        college.value=temp["college"];
                        department.value=temp["department"]; 
                    }
                    
                }
                
            }
        );
    
}


retreive_from_server(user_ID,"1");

function update_data_in_server(ID){
    const data={"check":"3","id":ID,"name":Name.value,"email":email.value,"age":age.value,"college":college.value,"department":department.value};
    $.ajax(
        {
            url:"./php/profile.php",
            method:"post",
            data:data,
            datatype:"html",
            success:function(res){
                console.log(res);
            }
            
        }
    );    
}


check_box.addEventListener("change",function(){
    
    if(check_box.checked){
        edit_box.style.display="flex";
        show_box.style.display="none";
        retreive_from_server(user_ID,"0");
        console.log(1);
    }
    else{
        //we need to retreive the data
        
        retreive_from_server(user_ID,"1");
        edit_box.style.display="none";
        show_box.style.display="flex";
        console.log(0);
    }
})

// check=1 means insert data
//check=2 means read data
//check=3 means update data