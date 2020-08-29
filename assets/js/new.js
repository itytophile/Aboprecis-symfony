let isFirst;

buttonChannel.onclick = sendChannel;

let jokeText = 
'The form was not valid, attack attempt\
 detected. A recording of your actions has been\
 sent to the nearest Police station (joke).';

 window.onkeydown = event => {
   if(event.keyCode == 13) {
     event.preventDefault();
     return false;
   }
 }

function sendChannel() {
  buttonChannel.classList.add('is-loading');
  let formData = new FormData(firstForm);
  fetch('/profile/new/get', {
    method: 'POST',
    body: formData,
  })
  .then(res => res.json())
  .then(json => {
    if(json.isValid) {
      processChannels(json.channels);
    } else {
      console.log(jokeText);
    }
  })
  .catch(err => console.log(err));
}

function processChannels(channels) {
  isFirst = true;
  channels.forEach(channel => {
    const column = document.createElement('div');
    column.classList.add('column');

    const card = getCard(channel);

    column.appendChild(card);

    columns.appendChild(column);
  });
  firstForm.remove();
}

function getCard(channel) {
  const card = document.createElement('div');
  card.classList.add('card');
  const header = getHeader(channel);
  card.appendChild(header);
  const cardImage = getCardImage(channel);
  card.appendChild(cardImage);
  const cardContent = getCardContent(channel);
  card.appendChild(cardContent);
  return card;
}

function getCardContent(channel) {
  const cardContent = document.createElement('div');
  cardContent.classList.add('card-content');
  const content = document.createElement('div');
  content.classList.add('content');
  content.textContent = channel.description;

  const contentButton = document.createElement('div');
  contentButton.classList.add('content');
  const button = getButton(channel);

  contentButton.appendChild(button);
  cardContent.appendChild(content);
  cardContent.appendChild(contentButton);
  return cardContent;
}

function getButton(channel) {
  const button = document.createElement('button');
  button.classList.add('button');
  if (isFirst) {
    button.classList.add('is-success');
    isFirst = false;
  }
  button.textContent = 'Choose';
  button.onclick = () => {
    // You can put what you want here I don't care
    // No motivation to do server-side checking
    sub_channel.value = channel.id;
    sub_title.value = channel.title;
    columns.remove();
    title.textContent = channel.title;
    title.href = channel.url;
    finalForm.removeAttribute('hidden');
  };
  return button;
}

function getCardImage(channel) {
  const cardImage = document.createElement('div');
  cardImage.classList.add('card-image');
  const a = document.createElement('a');
  a.href = channel.url;
  a.rel = 'noopener noreferrer';
  a.target = '_blank';
  const figure = document.createElement('figure');
  figure.classList.add('image');
  figure.classList.add('is-64x64');
  const img = document.createElement('img');
  img.src = channel.img;
  img.alt = "Channel image";
  figure.appendChild(img);
  a.appendChild(figure);
  cardImage.appendChild(a);
  return cardImage;
}

function getHeader(channel) {
  const header = document.createElement('header');
  header.classList.add('card-header');
  const p = document.createElement('p');
  p.classList.add('card-header-title');
  p.textContent = channel.title;
  header.appendChild(p);
  return header;
}
