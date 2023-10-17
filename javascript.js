
function show_com(id_com,reference,qte){
    //alert(var1)
   document.getElementById('id_com').value=id_com;
   document.getElementById('reference').value=reference;
   document.getElementById('qte').value=qte;
}
    
    function afficher(){
        let popup=document.getElementById("test");
        popup.classList.remove("hi");
        popup.classList.add("active");
    
}


function fermer(var1){
    if(var1==1){
    let popup=document.getElementById("test1");
    popup.classList.remove("active1");
    popup.classList.add("hi1");
}
    else { let popup=document.getElementById("test");
    popup.classList.remove("active");
    popup.classList.add("hi");
}

    //this.Hide()
}
function modifier(id,nom,tele,adresse,email){
   // nom=toString(nom)
  //  document.write(id,nom,tele,adresse,email)
    let popup1=document.getElementById("test1");
    document.getElementById('id').value=id
    document.getElementById('nom').value=nom
     document.getElementById('adresse').value=adresse
     document.getElementById('tele').value=tele
     document.getElementById('email').value=email
    popup1.classList.remove("hi1");
       popup1.classList.add("active1");
}
