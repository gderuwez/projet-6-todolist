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

$("input[type=checkbox]").click(function(){
  let check = $(this);
  if (check.is(':checked')) {
    let value = check.next();
    let breakbal = value.next();
    breakbal.detach();
    value.detach();
    check.detach();
    $($('.archive')).append(check);
    $($('.archive')).append(value);
    $($('.archive')).append(breakbal);
    $.post('process.php', check.val());
  }
  else {
    console.log('unchecked');
    let next = $(this).next();
    let nextNext = next.next();
    nextNext.detach();
    next.detach();
    $(this).detach();
    $($('.todo')).append(this);
    $($('.todo')).append(next);
    $($('.todo')).append(nextNext);
  }
});
