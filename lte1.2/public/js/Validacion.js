function loguear(){
    let user=document.getElementById("usuario").value;
    
    let pass=document.getElementById("clave").value;

    if(user=="Piston@gmail.com" && pass=="1234"){
        window.location="file:///C:/Users/Aprendiz/Desktop/Proyecto%20Gaes%204/Carousel/Dashboard.html";
    }

    else{
        alert("Los datos que usted ha ingresado son los incorrectos")
    }

}