<script>
let timer;

document.addEventListener('input', e => {
  const el = e.target;
  console.log("elele")
  console.log(el)
  if( el.matches('[data-color]') ) {
    clearTimeout(timer);
    timer = setTimeout(() => {
      document.documentElement.style.setProperty(`--color-${el.dataset.color}`, el.value);
    }, 100)
  }
})
document.addEventListener('span', e => {
  const el = e.target;
  console.log("elele")
  console.log(el)
  if( el.matches('[data-color]') ) {
    clearTimeout(timer);
    timer = setTimeout(() => {
      document.documentElement.style.setProperty(`--color-${el.dataset.color}`, el.value);
    }, 100)
  }
})
function addAddress(e){
    var ele=document.getElementById('addaddressform');
    ele.setAttribute("style","display:block");
}
function hideForm(){
    var ele=document.getElementById('addaddressform');
    ele.setAttribute("style","display:none");
}
</script>