function showAnotherDiv() {
  var divToDisplay = document.getElementById("divToDisplay");
  if (document.getElementById("timePeriod").value == "custom")
  {
    divToDisplay.hidden  = false;
  }
  else
  {
    divToDisplay.hidden  = true;
  }
}