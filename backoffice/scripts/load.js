document.addEventListener('DOMContentLoaded', () => {
  const dataContainer = document.querySelector('.data-container');
  dataContainer.innerHTML += Loader();
  const allData = './backend/allData.php';
  const token = document.querySelector('input[type="hidden"]').value;
  const tokenData = new FormData();
  tokenData.append('token', token);
  fetch(allData, {
    method: 'POST',
    body: tokenData
  }).then(res => res.json()).then(data => {
    sessionStorage.setItem('data', JSON.stringify(data));
    let htmlAccumulator = '';
    const messages = data[0].data;
    for (let i = 0; i < messages.length; i++){
      "id", 'fullname', 'email', 'message', 'is_read', 'date'
      const message = messages[i];
      const msgText = message.message;
      let previewMsg = '';
      if (msgText.length > 40) {
        previewMsg = msgText.substr(0, 40) + '...';
      } else {
        previewMsg = msgText;
      }
      htmlAccumulator += 
      `<tr id="${message.id}" onclick="openMsg(${message.id})">
        <td>${message.email}</td>
        <td>${message.previewMsg}</td>
        <td>${message.date}</td>
      </tr>`;
    }
    const messageContainer = document.getElementById('message-container');
    messageContainer.innerHTML = htmlAccumulator;
  });
})

function openMsg(id) {
  
}

function Loader() {
  return `
  <div class="loader">
   <div class="text">Fetching data...</div>
    <div class="dots">
      <div class="dot" style="animation-delay:none;">.</div>
      <div class="dot" style="animation-delay:500ms;">.</div>
      <div class="dot" style="animation-delay:1000ms;">.</div>
    </div>
  </div>`;
}
