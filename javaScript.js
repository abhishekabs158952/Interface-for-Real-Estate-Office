function afd(){
    document.getElementById("agentForm").style.display= "block";
    document.getElementById("selleddetail").style.display= "block";
    document.getElementById("renteddetail").style.display= "none";
}
function sdd(){
    document.getElementById("agentForm").style.display= "none";
    document.getElementById("selleddetail").style.display= "block";
    document.getElementById("renteddetail").style.display= "block";
}
function cityDetail(){
    document.getElementById("cityView").style.display= "block";
    document.getElementById("agentView").style.display= "none";
    document.getElementById("agentDetail").style.display= "none";
    document.getElementById("addAgent").style.display= "none";
}
function addAgent(){
    document.getElementById("cityView").style.display= "none";
    document.getElementById("agentView").style.display= "none";
    document.getElementById("agentDetail").style.display= "none";
    document.getElementById("addAgent").style.display= "block";
}
function agentWork(){
    document.getElementById("cityView").style.display= "none";
    document.getElementById("agentView").style.display= "block";
    document.getElementById("agentDetail").style.display= "none";
    document.getElementById("addAgent").style.display= "none";
}
function viewAgent(){
    document.getElementById("agentView").style.display= "block";
    document.getElementById("agentDetail").style.display= "block";
    document.getElementById("addAgent").style.display= "none";
}
function bfun(){
    document.getElementById("sellList").style.display= "block";
    document.getElementById("reqList").style.display= "block";
}
function f1(){
    document.getElementById("tab").style.display= "none";
}
