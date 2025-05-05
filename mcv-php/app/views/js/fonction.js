function verifChamps()
{
    if (document.getElementById('nom').value =="" || 
      document.getElementById('mdp').value =="")
    {
      alert("Remplir tous les champs");
      return false;
    }
}