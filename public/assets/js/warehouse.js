function checkAgain(){
    if (confirm("確定刪除此行?")) {
        return true;
    }else{
        return false;
    }
}
function addNew(){
    document.getElementById('dailog').style.display = "block";
}
function closedlg(){
    document.getElementById('dailog').style.display = "none";
}