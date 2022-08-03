const noteBook = document.getElementById("notesContainer");
const ANBtn = document.getElementById("addNote");
const pinned = document.createElement('div');
const nonPinned = document.createElement('div');
const fullNotes = localStorage.getItem('Notes')!=='undefined'?JSON.parse(localStorage.getItem('Notes')):undefined;
noteBook.append(pinned, nonPinned);
nonPinned.style.display = pinned.style.display = 'inline';
let NoteTop, NoteLeft, funcArr=[], activeList='Home';
let gotNotes=[], totalNotes;
const lists = {};

document.body.style.minHeight = `${screen.availHeight}`;

const footer = document.createElement('footer');
footer.classList.add('footer');
const footerPosition = e => {
  if(document.body.scrollHeight < window.innerHeight){
    footer.style.bottom = '0';
  }else{
    footer.style.bottom = 'auto';
  }
}

const str = (s) => `<span style='position: absolute;'>${s}</span>`;

function container(width){
  const div = document.createElement('div');
  div.setAttribute('style', `
    box-sizing: border-box;
    padding: 10px; background: #1b2530;
    border-radius: 10px; border: 1px solid #FEE715;
    position: fixed; z-index: 10;
    height: 300px; width: ${width}px;
    top: calc(50% - 150px);
    left: calc(50% - ${width/2}px);
  `)
  return div;
}

const listBtn = document.createElement('button');
listBtn.innerHTML = str('My Lists');

function removeBack(e=null){
  e?e.stopImmediatePropagation():0;
  document.body.firstChild.remove();
  background.removeEventListener('click', removeBack);
  let opacity = 1;
  const opacityInterval = setInterval(e => {
    background.style.opacity = opacity;
    if(opacity <= 0){
      clearInterval(opacityInterval);
      background.style.display = 'none';
    }
    opacity -= .1;
  }, 10)
}

listBtn.addEventListener('click', e => {
  const listBox = container(300);
  let opacity = 0;
  const opacityInterval = setInterval(e => {
    background.style.opacity = opacity;
    if(opacity >= 1){
      clearInterval(opacityInterval);
    }
    opacity += .1;
  }, 10)
  background.style.display = 'block';
  background.addEventListener('click', removeBack);

  const listName = document.createElement('input');
  listName.setAttribute('style', `
    box-sizing: inherit; outline: none;
    border-radius: 10px; border: 1px solid #FEE715;
    width: 100%; height: 30px;
    padding: 10px; font-family: inherit;
    color: white; background: transparent;
  `)
  listName.placeholder = 'Search Lists';
  
  const listCount = document.createElement('div');
  listCount.setAttribute('style', `
    font-size: 12px; color: gray;
    padding-top: 5px; text-align: right;
  `)
  listCount.innerHTML = `${Object.keys(lists).length!==0?Object.keys(lists).length:'No'} List${Object.keys(lists).length>1?'s':''} found`

  
  const listList = document.createElement('div');
  listList.classList.add('listList');

  for(let x=0, keys=Object.keys(lists); x<keys.length; x++){
    const list = document.createElement('div');
    list.innerHTML = keys[x];
    list.addEventListener('click', e => {
      nonPinned.innerHTML = pinned.innerHTML = '';
      activeList = keys[x];
      removeBack();
      for(let y=0; y<Object.values(lists)[x].length; y++){
        noteAdder(null, Object.values(lists)[x][y], Object.values(lists)[x][y].pinned, Object.values(lists)[x][y].size, Object.values(lists)[x][y].NoteTitle, keys[x])
      }
    })
    listList.append(list);
  }
  
  listBox.append(listName, listCount, listList);
  document.body.prepend(listBox);
  listName.focus();
})

const themeBtn = document.createElement('button');
themeBtn.innerHTML = str('Theme');

footer.append(listBtn, themeBtn);
document.body.onscroll = footerPosition;
document.body.append(footer);


const background = document.createElement('div');
background.classList.add('background');
background.style.height = `${screen.height}px`;
background.style.width = `${screen.width}px`;
background.style.position = 'fixed';
background.style.zIndex = '5';
background.style.display = 'none';
background.style.opacity = '0';
background.style.background = '#000000a8';
background.style.transition = 'opacity .4s';
document.body.prepend(background)

if(fullNotes){
  for(totalNotes = 0; totalNotes<Object.values(fullNotes).length; totalNotes++){
    gotNotes.push(Object.values(fullNotes)[totalNotes][0]);
  }
}

document.addEventListener('scroll', e => {
  if(scrollY >= parseInt(getComputedStyle(document.querySelector('.Header')).height.replace('px',''))){
    ANBtn.style.position = 'fixed';
    ANBtn.style.top = '10px';
  }else{
    ANBtn.style.position = 'absolute';
    ANBtn.style.top = 'auto';
  }
})

const updateLocalStorage = () => {
  let notes = {}, k;
  for(k=0; k<pinned.childNodes.length; k++){
    pinned.childNodes[k].firstChild.childNodes[2].value!==''?notes[`n${k+1}`] = [pinned.childNodes[k].firstChild.childNodes[2].value, pinned.childNodes[k].firstChild.pinned, pinned.childNodes[k].firstChild.size, pinned.childNodes[k].firstChild.NoteTitle, activeList]:0;
  }
  for(let j=0; j<nonPinned.childNodes.length; j++){
    nonPinned.childNodes[j].firstChild.childNodes[2].value!==''?notes[`n${++k}`] = [nonPinned.childNodes[j].firstChild.childNodes[2].value, nonPinned.childNodes[j].firstChild.pinned, nonPinned.childNodes[j].firstChild.size, nonPinned.childNodes[j].firstChild.NoteTitle, activeList]:0;
  }
  localStorage.setItem('Notes', JSON.stringify(notes))
}

const textSaver = Note => {
  Note.childNodes[3].innerHTML = Note.childNodes[2].value;
  Note.childNodes[2].style.display = 'none';
  Note.childNodes[3].style.display = 'block';
  Note.style.top = `${NoteTop}px`;
  Note.style.left = `${NoteLeft}px`;
  setTimeout(() => {
    Note.style.top = 'auto';
    Note.style.left = 'auto';
  }, 400)
  resizeFunc(Note, Note.size);
  Note.style.height = `220px`;
  Note.childNodes[0].contentEditable = false;
  Note.childNodes[1].childNodes[2].style.display = 'block';
  Note.NoteTitle = Note.childNodes[0].innerHTML;
  let opacity = 1;
  background.removeEventListener('click', Note.listener)
  const opacityInterval = setInterval(e => {
    background.style.opacity = opacity;
    if(opacity <= 0){
      clearInterval(opacityInterval);
      Note.style.zIndex = 0;
      background.style.display = 'none';
    }
    opacity -= .1;
  }, 10)
  gotNotes.push(Note.childNodes[2].value);
  updateLocalStorage()
};

const editFunc = Note => {
  Note.childNodes[2].style.display = 'block';
  Note.childNodes[3].style.display = 'none';
  NoteTop = Number(getComputedStyle(Note).top.slice(0, getComputedStyle(Note).top.indexOf('px')));
  NoteLeft = Number(getComputedStyle(Note).left.slice(0, getComputedStyle(Note).left.indexOf('px')))
  Note.style.top = `${NoteTop}px`;
  Note.style.left = `${NoteLeft}px`;
  const height = Number(getComputedStyle(Note).height.slice(0, getComputedStyle(Note).height.indexOf('px')))*2;
  const width = window.innerWidth - 100;
  Note.childNodes[1].childNodes[2].style.display = 'none';
  Note.style.top = `${(window.innerHeight/2 - height/2) + document.documentElement.scrollTop}px`;
  Note.style.left = `${window.innerWidth/2 - width/2}px`;
  Note.style.maxWidth = '700px';
  Note.style.width = `${width}px`;
  Note.style.height = `${height}px`;
  Note.childNodes[0].contentEditable = true;
  let opacity = 0;
  const opacityInterval = setInterval(e => {
    background.style.opacity = opacity;
    if(opacity >= 1){
      clearInterval(opacityInterval);
    }
    opacity += .1;
  }, 10)
  background.style.display = 'block';
  background.addEventListener('click', Note.listener);
  Note.style.zIndex = 10;
  setTimeout(() => {
    Note.childNodes[0].focus();
  }, 400)
};

const deleteFunc = Note => {
  nonPinned.contains(Note)?nonPinned.removeChild(Note):pinned.removeChild(Note);
  gotNotes.splice(Note.identity-1, 1);
  background.style.display = 'none';
  footerPosition();
  updateLocalStorage();
}

let count=0;
const resizeFunc = (Note, boxNo, container=false) => {
  if(boxNo === 1){
    Note.parentElement.style.width = Note.style.width = '222.5px';
    Note.size = 1;
  }else if(boxNo === 2){
    Note.parentElement.style.width = Note.style.width = '471.5px';
    Note.size = 2;
  }else{
    Note.parentElement.style.width = Note.style.width = '720.5px';
    Note.size = 3;
  }
  setTimeout(e=>footerPosition(), 400)
  container?container.style.display='none':0;
  updateLocalStorage();
};

const copyFunc = Note => {
  navigator.clipboard.writeText(Note.childNodes[2].innerHTML);
  document.querySelector('.message').style.display = 'block';
  setTimeout(()=>{
    document.querySelector('.message').style.display = 'none';
  }, 1500)
}

const pinFunc = Note => {
  if(!Note.firstChild.pinned){
    Note.firstChild.childNodes[1].childNodes[4].classList.add('Pinned');
    pinned.append(Note)
    pinned.lastChild.firstChild.pinned = true;
    updateLocalStorage();
  }else{
    Note.firstChild.childNodes[1].childNodes[4].classList.remove('Pinned');
    nonPinned.prepend(Note)
    nonPinned.firstChild.firstChild.pinned = false;
    updateLocalStorage();
  }
}


function noteAdder(e, note, isPinned, size, title, list){
  const noteArea = document.createElement("div");
  noteArea.classList.add("backNote");

  const Note = document.createElement('div');
  Note.classList.add('Note')
  Note.identity = totalNotes++;
  Note.pinned = isPinned;
  noteArea.append(Note)
  
  const operations = document.createElement('div');
  operations.classList.add('operations');
  
  const deleteBtn = document.createElement('div');
  deleteBtn.classList.add('Delete')
  deleteBtn.title = 'Delete this note.';
  deleteBtn.addEventListener('click', e=>deleteFunc(noteArea))

  const editBtn = document.createElement('div');
  editBtn.classList.add('Edit');
  editBtn.title = 'Edit this note.';
  editBtn.addEventListener('click', e=>editFunc(Note))


  const boxContainer = document.createElement('div');
  boxContainer.classList.add('parentBox');

  for(let z=1; z<=3; z++){
    const box = document.createElement('div');
    box.addEventListener('click', e=>resizeFunc(Note, z, boxContainer));
    box.classList.add('box');
    boxContainer.append(box);
  }


  const resizeBtn = document.createElement('div');
  resizeBtn.classList.add('Resize');
  resizeBtn.title = 'Enlarge/dwindle this note.';
  resizeBtn.addEventListener('click', e=>boxContainer.style.display='flex')

  const copyBtn = document.createElement('div')
  copyBtn.classList.add('Copy');
  copyBtn.title = 'Copy this note.';
  copyBtn.addEventListener('click', e=>copyFunc(Note))

  const pinBtn = document.createElement('div');
  pinBtn.classList.add('Pin');
  pinBtn.title = 'Pin this note.';
  isPinned?pinBtn.classList.add('Pinned'):0;
  pinBtn.addEventListener('click', e=>pinFunc(noteArea))

  operations.append(deleteBtn, copyBtn, resizeBtn, editBtn, pinBtn, boxContainer)


  const textArea = document.createElement('textarea');
  textArea.classList.add('noteTextTaker');
  note===''?null:textArea.style.display='none';
  textArea.value=note;

  const ReadOnlyDiv = document.createElement('div');
  ReadOnlyDiv.classList.add('noteText');
  note===''?null:ReadOnlyDiv.style.display='block';
  ReadOnlyDiv.innerHTML=note;

  const titleDiv = document.createElement('div');
  titleDiv.classList.add('noteTitle');
  titleDiv.innerHTML = title!==''?title:'Title';

  Note.append(titleDiv, operations, textArea, ReadOnlyDiv);
  Note.NoteTitle = titleDiv.innerHTML;
  Note.size = size;
  Note.listener = e=>textSaver(Note);
  if(list === activeList){
    isPinned ? pinned.append(noteArea) : note==='' ?nonPinned.prepend(noteArea):nonPinned.append(noteArea)
    note==='' ? editFunc(Note) : 0;
    note!==''?resizeFunc(Note, Note.size):0;
  }
  !lists[list] ? lists[list] = []:0;
  lists[list].push(noteArea);
  footerPosition();
};
if(fullNotes){
  for(i=0; i < gotNotes.length; i++){
    noteAdder(null, Object.values(fullNotes)[i][0], Object.values(fullNotes)[i][1], Object.values(fullNotes)[i][2], Object.values(fullNotes)[i][3], Object.values(fullNotes)[i][4])
    // noteAdder(null, Object.values(fullNotes)[i][0], Object.values(fullNotes)[i][1], Object.values(fullNotes)[i][2], Object.values(fullNotes)[i][3], activeList)
  }
}

footerPosition();
ANBtn.addEventListener("click", e=>noteAdder(e, '', false, 1, '', activeList));