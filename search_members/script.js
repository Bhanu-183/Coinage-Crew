
var s = "";
function validate(el, value) {
  var ul = document.getElementById("selected");
  var li = document.createElement("li");
  li.className = "list-group-item list-group-item-success"
  li.appendChild(document.createTextNode(el.parentNode.textContent));
  ul.appendChild(li);
  el.parentNode.style.display = 'none';
  s = s + value + ',';
  document.getElementById('hidden_input').value = s;
}

function myFunction() {
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  ul = document.getElementById("myUL");
  li = ul.getElementsByTagName("li");
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
