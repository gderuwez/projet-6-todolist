// if ('serviceWorker' in navigator) {
//   window.addEventListener('load', function() {
//     navigator.serviceWorker.register('service-worker.js').then(function(registration) {
//       // Registration was successful
//       console.log('ServiceWorker registration successful with scope: ', registration.scope);
//     }, function(err) {
//       // registration failed :(
//       console.log('ServiceWorker registration failed: ', err);
//     });
//   });
// }

const test = (check, classtouse, keyword, content) => {
  let data = {};
  let value = check.next();
  let breakbal = value.next();
  data[keyword] = content;
  breakbal.detach();
  value.detach();
  check.detach();
  $($(classtouse)).append(check);
  $($(classtouse)).append(value);
  $($(classtouse)).append(breakbal);
  $.post('process.php', data);
}

$("input[type=checkbox]").click(function(){
  let check = $(this);
  let content = check.val();
  if (check.is(':checked')) {
    test(check, '.archive', 'archive', content);
  }
  else {
    test(check, '.todo', 'todo', content);
  }
});
