<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Notes</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon">
    <style>
    *,
*::after,
*::before{
  margin: 0;
  padding: 0;
}
body{
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: var(--primary);
}
html{
  overflow-x: hidden;
}

::-webkit-scrollbar{width: 15px;}
::-webkit-scrollbar-track-piece{background-color: dimgray}
::-webkit-scrollbar-thumb{background-color: var(--primary); border: 1px solid gray;}
::-webkit-scrollbar-corner{background-color: dimgray}

/* Main content */

.message{
  position: fixed;
  left: 50%;
  top: 10px;
  transform: translate(-50%, 0);
  padding: 5px;
  font-size: 16px;
  background: var(--primary);
  display:none;
  border-radius: 5px;
  color: var(--text-color);
  font-weight: 500;
}
.Header{
  font-size: 40px;
  font-weight: 350;
  padding: 20px;
  display: flex;
  color: var(--primary);
  cursor: default;
  justify-content: flex-start;
  align-items: center;
  background-color: var(--secondary);
}
.Header span::selection, .HeaderIMG::selection{
  font-size: 40px;
}
.HeaderIMG{
  height: 60px;
  width: 60px;
  margin-right: 10px;
}
#addNote{
  font-size: 20px;
  display: flex;
  align-items: center;
  margin-top: 20px;
  z-index: 4;
  right: 50px;
  position: absolute;
  color: var(--secondary);
  padding-left: 5px;padding-right: 5px;
  transition: color .35s ease-in-out;
}
.ANText::selection, .Plus span::selection{
  cursor: pointer;
}
.ANText{
  cursor: pointer;
  margin-top: -3px;
}
.Plus{
  font-size: 30px;
  height: 40px;
  width: 40px;
  background-color: var(--secondary);
  border-radius: 20px;
  margin-right: 10px;
  display: flex;
  justify-content: flex-start;
  cursor: pointer;
  transition: width .55s, margin-right .55s, transform .55s, box-shadow .55s;
}
.Plus span{
  margin-top: -3px;
  height: 40px;
  width: 40px;
  color: var(--primary);
  text-align: center;
  transition: transform .55s, margin-top .55s;
}
#addNote:hover{
  color: var(--primary);
}
#addNote:hover .Plus{
  width: 150px;
  margin-right: -100px;
}
#addNote:hover .Plus span{
  transform: rotate(180deg);
  margin-top: 3px;
}
#notesContainer{
  margin: 25px;
  margin-top: 100px;
  margin-right: 0px;
}

/* Notes */

.Note{
  height: 220px;
  width: 222.5px;
  border-radius: 10px;
  position: absolute;
  border-bottom-right-radius: 0;
  background: var(--primary-light);
  border: 1px solid var(--secondary);
  transition: top .4s, left .4s, width .4s, height .4s, box-shadow .4s;
}
.backNote{
  display: inline-block;
  margin-right: 26.5px;
  margin-bottom: 26.5px;
  height: 220px;
  width: 222.5px;
  transition: width .4s;
}
.noteTitle{
  position: absolute;
  transform: translate(0, -50%);
  max-width: 200px;
  outline: none;
  box-sizing: border-box;
  padding-left: 20px;
  padding-right: 5px;
  height: 20px;
  overflow: hidden;
  min-width: 150px;
  color: var(--text-color);
  font-size: 13px;
  border: 1px solid var(--secondary);
  background: var(--primary-light);
}
.operations{
  height: 35px;
  width: 100%;
  margin-top: 5px;
}
.Delete{
  background-image: var(--deleteImage)
}
.Edit{
  background-image: var(--editImage)
}
.Resize{
  background-image: var(--resizeImage)
}
.Copy{
  background-image: var(--copyImage)
}
.Resize, .Edit, .Delete, .Copy{
  height: 35px;
  width: 35px;
  float: right;
  transition: transform .3s;
  background-position: center;
  background-size: contain;
  background-repeat: no-repeat;
  cursor: pointer !important;
}
.Resize:hover, .Edit:hover, .Delete:hover, .Copy:hover, .Pin:hover{
  transform: scale(1.2, 1.2);
}
.Resize:hover ~ div [t3], .Edit:hover ~ div [t2], .Delete:hover ~ div [t1], .Copy:hover ~ div [t4], .Pin:hover ~ div [t5]{
  transition-delay: .5s;
  visibility: visible;
}
.Pin{
  height: 25px;
  width: 25px;
  border-radius: 50%;
  float: left;
  margin-left: -12.5px;
  margin-top: -18px;
  background: var(--primary-light);
  position: absolute;
  border: 1px solid var(--secondary);
  background-image: var(--pinImage);
  background-size: 16px 16px;
  background-position: center;
  background-repeat: no-repeat;
  cursor: pointer;
  transition: transform .3s;
}
.Pinned{
  background-color: var(--secondary);
  background-image: var(--pinnedImage);
}
.parentBox{
  padding: 5px;
  display: none;
  position: absolute;
  z-index: 10;
  margin-top: -125px;
  background-color: var(--primary);
  border: 1px solid var(--secondary);
  filter: brightness(90%);
  border-radius: 10px;
}
.box{
  background-color: darkgray;
  height: 75px;
  width: 80px;
  margin: 5px;
  border-radius: 10px;
}
.box:nth-child(2){
  width: 180px;
}
.box:last-child{
  width: 280px;
}
.noteTextTaker{
  width: 100%;
  resize: none;
  border: none;
  font-size: 15px;
  outline: none;
  background-color: var(--primary-light);
  color: var(--text-color);
  height: calc(100% - 45px);
  min-height: 135px;
  border-radius: 10px;
  padding: 10px;
  margin-top: 5px;
  overflow-y: scroll;
}
.noteTextTaker, .noteText{
  box-sizing: border-box;
  width: 100%;
  padding: 10px;
  margin-top: 5px;
}
.noteText{
  height: calc(100% - 45px);
  font-size: 14px;
  overflow: auto;
  color: var(--text-color);
  word-wrap: break-word;
}

/* footer */

.footer{
  background: var(--secondary);
  padding-top: 25px;padding-bottom:25px;
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  width: 100%;
  position: absolute;
}
.button{
  height: 40px;
  min-width: 100px;
  background: var(--button);
  color: var(--secondary);
  border: none;
  font-family: inherit;
  border-radius: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  outline: none;
  cursor: pointer;
  font-weight: 500;
}
.button::before{
  content: '';
  display: block;
  height: 40px;
  width: 100px;
  left: -100px;
  transition: left .3s ease-out;
  position: relative;
  background: var(--primary);
}
.button:hover::before{
  left: 0px;
}
.listList{
  display: flex;
  flex-direction: column;
  height: 230px;
  overflow: auto;
}
.listList::-webkit-scrollbar{
  width: 12px;
}
.listList::-webkit-scrollbar-thumb{
  border: 3px solid var(--primary-light);
  background-color: var(--primary);
  border-radius: 9px;
}
.listList::-webkit-scrollbar-thumb:hover{
  background-color: var(--primary-lighter);
}
.listList::-webkit-scrollbar-track-piece{
  background-color: transparent;
}
.listList div{
  border-bottom: 1px solid var(--secondary);
  padding: 5px;
  cursor: pointer;
  margin-top: 5px;margin-bottom:5px;
  font-size: 15px;
  padding-top: 10px;
  color: var(--text-color);
  transition: color .3s;
}
.listList div:hover{
  color: #c8c8c8;
}
.label{
  box-sizing: border-box;
  border-radius: 10px;
  font-size: 10px;
  float: right;
  color: var(--secondary);
  border: 1px solid var(--secondary);
  margin-left: 10px;
  padding-bottom: 2.5px;
  padding-right: 5px;padding-left: 5px;
}
.query{
  background: var(--secondary);
  border-radius: 2.5px;
  color: var(--primary);
}
.themeBtns{
  box-sizing: border-box;
  width: calc((100%/2) - 5px);
  height: 100%;
  text-align: center;
  color: var(--text-color);
  padding: 10px;
  background: var(--primary);
  display: inline-block;
  border-radius: 10px;
  transition: transform .3s;
}
.themeBtns:hover{
  transform: scale(1.05, 1.05);
}
    </style>
  </head>
  <body>
    <div class="message">Copied!</div>
    <div class="Header">
      <img class="HeaderIMG" alt="logo"><span>My Notes</span>
      <div class="formatter"></div>
    </div>
    <div id="addNote">
      <span class="Plus">
        <span>+</span>
      </span>
      <span class = "ANText">Add Note</span>
    </div>
    <div id="notesContainer"></div>

    <script>
      const div = () => document.createElement('div');
      const noteBook = document.getElementById("notesContainer");
      const ANBtn = document.getElementById("addNote");
      const pinned = div();
      const nonPinned = div();
      const fullNotes = localStorage.getItem('Notes')?JSON.parse(localStorage.getItem('Notes')).note:undefined;
      noteBook.append(pinned, nonPinned);
      nonPinned.style.display = pinned.style.display = 'inline';
      let NoteTop, NoteLeft, funcArr=[], activeList='Home', theme=JSON.parse(localStorage.getItem('Notes'))?.theme;
      let gotNotes=[], totalNotes;
      const lists = {
        Home : []
      };

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

      function container(width, height=300){
        const myDiv = div();
        myDiv.setAttribute('style', `
          box-sizing: border-box;
          padding: 10px; background: var(--primary-light);
          border-radius: 10px; border: 1px solid var(--secondary);
          position: fixed; z-index: 10;
          height: ${height}px; width: ${width}px;
          top: calc(50% - ${height/2}px);
          left: calc(50% - ${width/2}px);
        `)
        return myDiv;
      }

      const listBtn = document.createElement('button');
      listBtn.innerHTML = str('My Lists');
      listBtn.classList.add('button');

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

      const backInterval = () => {
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
      }

      listBtn.addEventListener('click', e => {
        const listBox = container(300);
        backInterval();

        const listName = document.createElement('input');
        listName.setAttribute('style', `
          box-sizing: inherit; outline: none;
          border-radius: 10px; border: 1px solid var(--secondary);
          width: 100%; height: 30px;
          padding: 10px; font-family: inherit;
          color: var(--text-color); background: transparent;
        `)
        listName.placeholder = 'Search Lists';
        listName.addEventListener('input', e=>searchList(listName.value))
        
        const listCount = div();
        listCount.setAttribute('style', `
          font-size: 12px; color: gray;
          padding-top: 5px; text-align: right;
        `)

        
        const listList = div();
        listList.classList.add('listList');

        function searchList(query){
          const values = Object.values(lists);
          listList.innerHTML = '';
          const func = (list, keys, x, valuesLength) => {
            list.addEventListener('click', e => {
              nonPinned.innerHTML = pinned.innerHTML = '';
              activeList = keys[x];
              removeBack();
              for (let y = 0; y < valuesLength; y++) {
                values[x][y].firstChild.pinned ? pinned.append(values[x][y]) : values[x][y].firstChild.childNodes[2].value==='' ?nonPinned.prepend(values[x][y]):nonPinned.append(values[x][y]);
              }
              footerPosition();
            });
            listList.append(list);
          }
          for(let x = 0, keys = Object.keys(lists); x < keys.length; x++){
            const list = div();
            const valuesLength = values[x].length;
            const add = () => func(list, keys, x, valuesLength)
            if(query && keys[x].includes(query)){
              list.innerHTML = (keys[x].length > 30 ? keys[x].slice(0, 28) + '...' : keys[x]).replaceAll(query, `<span class='query'>${query}</span>`) + (keys[x] === 'Home' ? '<span class="label">default</span>' : '') + (keys[x] === activeList ? '<span class="label">current</span>' : '');
              add();
            }else if(!query){
              list.innerHTML = (keys[x].length > 30 ? keys[x].slice(0, 28) + '...' : keys[x]) + (keys[x] === 'Home' ? '<span class="label">default</span>' : '') + (keys[x] === activeList ? '<span class="label">current</span>' : '');
              add();
            }
          }
          if(query && listList.children.length === 0){
            listCount.innerHTML = 'No List found';
            const create = document.createElement('button');
            create.innerHTML = str('Create List');
            create.classList.add('button');
            create.setAttribute('style', `
              align-self: center;
              position: relative;
              top: 100px;
            `);
            create.addEventListener('click', e => {
              pinned.innerHTML = '';
              nonPinned.innerHTML = '';
              lists[query] = [];
              activeList = query;
              removeBack();
            })
            listList.append(create);
          }else{
            listList.children.length===0?
            listCount.innerHTML = 'No List found'
            : listCount.innerHTML = `${listList.children.length} List${listList.children.length>1?'s':''} found`;
          }
        }

        searchList(false);
        
        listBox.append(listName, listCount, listList);
        document.body.prepend(listBox);
        listName.focus();
      })

      const themeBtn = document.createElement('button');
      themeBtn.innerHTML = str('Theme');
      themeBtn.classList.add('button');

      const properties = ['--primary', '--secondary', '--primary-light', '--primary-lighter', '--text-color', '--button', '--copyImage', '--deleteImage', '--resizeImage', '--editImage', '--pinImage', '--pinnedImage']
      const dark = ['#101820', '#FEE715', '#1b2530', '#455d77', 'white', '#101820d7', 'url("My Notes/Pictures/Dark Theme/CopyIcon.png")', 'url("My Notes/Pictures/Dark Theme/DeleteIcon.png")', 'url("My Notes/Pictures/Dark Theme/ResizeIcon.png")', 'url("My Notes/Pictures/Dark Theme/EditIcon.png")', 'url("My Notes/Pictures/Dark Theme/PinIcon.png")', 'url("My Notes/Pictures/Dark Theme/PinnedIcon.png")']
      const light = ['rgb(235, 235, 235)', '#222f38', '#f2f2ed', 'lightgray', 'black', '#d3d3cc', 'url("My Notes/Pictures/Light Theme/CopyIcon.png")', 'url("My Notes/Pictures/Light Theme/DeleteIcon.png")', 'url("My Notes/Pictures/Light Theme/ResizeIcon.png")', 'url("My Notes/Pictures/Light Theme/EditIcon.png")', 'url("My Notes/Pictures/Light Theme/PinIcon.png")', 'url("My Notes/Pictures/Light Theme/PinnedIcon.png")']

      const setTheme = e => {
        const root = document.querySelector(':root');
        for(let w = 0; w<properties.length; w++){
          root.style.setProperty(properties[w], theme==='dark'?dark[w]:light[w]);
        }
        document.querySelector('.HeaderIMG').src = theme==='dark'?'My Notes/Pictures/Dark Theme/HeaderFile.png':'My Notes/Pictures/Light Theme/HeaderFile.png';
      }

      themeBtn.addEventListener('click', e => {
        const themeBox = container(500, 235);
        themeBox.style.display = 'flex';
        themeBox.style.flexDirection = 'column';
        backInterval();

        const darkBtn = div();
        darkBtn.classList.add('themeBtns');
        darkBtn.innerHTML = `
          <img src='My Notes/Pictures/Dark Theme/Theme.png' height='130px' width='100%'><br>
          Dark Theme
        `;
        darkBtn.addEventListener('click', e=>{
          theme='dark';
          updateLocalStorage()
          setTheme()
        })

        const lightBtn = div();
        lightBtn.classList.add('themeBtns');
        lightBtn.innerHTML = `
          <img src='My Notes/Pictures/Light Theme/Theme.png' height='130px' width='100%'><br>
          Light Theme
        `;
        lightBtn.addEventListener('click', e=>{
          theme='light';
          updateLocalStorage()
          setTheme()
        })

        const btnContainer = div();
        btnContainer.style.display = 'flex';
        btnContainer.style.justifyContent = 'space-between';
        btnContainer.append(darkBtn, lightBtn);

        const title = div();
        title.setAttribute('style', `
          display: flex;
          align-items: flex-top;
          justify-content: center;
          color: var(--text-color);
          font-size: 20px;
          width: 100%;
          margin-bottom: 10px;
        `)
        title.innerHTML = 'Choose your Theme'

        themeBox.append(title, btnContainer);
        document.body.prepend(themeBox);
      })
      setTheme()


      footer.append(listBtn, themeBtn);
      document.body.onscroll = footerPosition;
      document.body.append(footer);


      const background = div();
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
        if(scrollY >= Number(getComputedStyle(document.querySelector('.Header')).height.replace('px','')) + (Number(getComputedStyle(document.querySelector('.Header')).padding.replace('px',''))*2)){
          ANBtn.style.position = 'fixed';
          ANBtn.style.top = 0;
        }else{
          ANBtn.style.position = 'absolute';
          ANBtn.style.top = 'auto';
        }
      })

      const updateLocalStorage = () => {
        let notes = {
          note: {},
          theme: theme
        }, k, l, m=0, keys;

        for(k=0, keys=Object.keys(lists); k<keys.length; k++){
          for(l=0; l<lists[keys[k]].length; l++, m++){
            lists[keys[k]][l].firstChild.childNodes[2].value!==''?notes.note[`n${m+1}`] = [lists[keys[k]][l].firstChild.childNodes[2].value, lists[keys[k]][l].firstChild.pinned, lists[keys[k]][l].firstChild.size, lists[keys[k]][l].firstChild.NoteTitle, keys[k]]:0;
          }
        }
        localStorage.setItem('Notes', JSON.stringify(notes))
      }

      const textSaver = Note => {
        Note.childNodes[3].innerHTML = Note.childNodes[2].value.replaceAll('\n', '<br>').replaceAll(' ', '&nbsp;');
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
        Note.childNodes[3].style.display = Note.childNodes[1].lastChild.style.display = 'none';
        NoteTop = Number(getComputedStyle(Note).top.replace('px', ''));
        NoteLeft = Number(getComputedStyle(Note).left.replace('px', ''));
        Note.style.top = `${NoteTop}px`;
        Note.style.left = `${NoteLeft}px`;
        const height = Number(getComputedStyle(Note).height.replace('px', ''))*2;
        const width = window.innerWidth - 100;
        Note.childNodes[1].childNodes[2].style.display = 'none';
        Note.style.top = `${(window.innerHeight/2 - height/2) + document.documentElement.scrollTop}px`;
        Note.style.left = `${window.innerWidth/2 - (width>700?700:width)/2}px`;
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
        lists[activeList].splice(lists[activeList].indexOf(Note), 1);
        background.style.display = 'none';
        footerPosition();
        updateLocalStorage();
      }

      let count=0;
      const resizeFunc = (Note, boxNo, container=false) => {
        container?container.style.display='none':0;
        if(boxNo === 1){
          Note.parentElement.style.width = Note.style.width = '222.5px';
          Note.size = 1;
        }else if(boxNo === 2){
          Note.parentElement.style.width = Note.style.width = window.innerWidth>471.5?'471.5px':window.innerWidth-50+'px';
          Note.size = 2;
        }else{
          Note.parentElement.style.width = Note.style.width = window.innerWidth>720.5?'720.5px':window.innerWidth-50+'px';
          Note.size = 3;
        }
        setTimeout(e=>footerPosition(), 400)
        updateLocalStorage();
      };

      const copyFunc = Note => {
        navigator.clipboard.writeText(Note.childNodes[2].value);
        document.querySelector('.message').style.display = 'block';
        setTimeout(()=>{
          document.querySelector('.message').style.display = 'none';
        }, 1500)
      }

      const pinFunc = Note => {
        if(!Note.pinned){
          Note.childNodes[1].childNodes[4].classList.add('Pinned');
          pinned.append(Note.parentElement);
          lists[Note.list].every((elem, index) => {
            if(!elem.firstChild.pinned){
              lists[Note.list].splice(lists[Note.list].indexOf(Note.parentElement), 1)
              lists[Note.list].splice(index-1, 0, Note.parentElement)
              return false;
            }
          })
          Note.pinned = true;
          updateLocalStorage();
        }else{
          Note.childNodes[1].childNodes[4].classList.remove('Pinned');
          nonPinned.prepend(Note.parentElement);
          Note.pinned = false;
          updateLocalStorage();
        }
      }


      function noteAdder(e, note, isPinned, size, title, list, mustPushed){
        const noteArea = document.createElement("div");
        noteArea.classList.add("backNote");

        const Note = div();
        Note.classList.add('Note')
        Note.NoteTitle = title;
        Note.size = size;
        Note.list = list;
        Note.identity = totalNotes++;
        Note.pinned = isPinned;
        noteArea.append(Note)
        
        const operations = div();
        operations.classList.add('operations');
        
        const deleteBtn = div();
        deleteBtn.classList.add('Delete')
        deleteBtn.title = 'Delete this note.';
        deleteBtn.addEventListener('click', e=>deleteFunc(noteArea))

        const editBtn = div();
        editBtn.classList.add('Edit');
        editBtn.title = 'Edit this note.';
        editBtn.addEventListener('click', e=>editFunc(Note))


        const boxContainer = div();
        boxContainer.classList.add('parentBox');

        for(let z=1; z<=3; z++){
          const box = div();
          box.addEventListener('click', e=>resizeFunc(Note, z, boxContainer));
          box.addEventListener('mouseover', e=>box.style.backgroundColor=theme==='dark'?'dimgray':'darkgray')
          box.addEventListener('mouseout', e=>box.style.backgroundColor=theme==='dark'?'darkgray':'lightgray')
          box.classList.add('box');
          boxContainer.append(box);
        }


        const resizeBtn = div();
        resizeBtn.classList.add('Resize');
        resizeBtn.title = 'Enlarge/dwindle this note.';
        resizeBtn.addEventListener('click', e=>boxContainer.style.display='flex')

        const copyBtn = div()
        copyBtn.classList.add('Copy');
        copyBtn.title = 'Copy this note.';
        copyBtn.addEventListener('click', e=>copyFunc(Note))

        const pinBtn = div();
        pinBtn.classList.add('Pin');
        pinBtn.title = 'Pin this note.';
        isPinned?pinBtn.classList.add('Pinned'):0;
        pinBtn.addEventListener('click', e=>pinFunc(Note))

        operations.append(deleteBtn, copyBtn, resizeBtn, editBtn, pinBtn, boxContainer)


        const textArea = document.createElement('textarea');
        textArea.classList.add('noteTextTaker');
        note===''?null:textArea.style.display='none';
        textArea.value=note;

        const ReadOnlyDiv = div();
        ReadOnlyDiv.classList.add('noteText');
        note===''?null:ReadOnlyDiv.style.display='block';
        ReadOnlyDiv.innerHTML=note.replaceAll('\n', '<br>').replaceAll(' ', '&nbsp;');

        const titleDiv = div();
        titleDiv.classList.add('noteTitle');
        titleDiv.innerHTML = title!==''?title:'Title';

        Note.append(titleDiv, operations, textArea, ReadOnlyDiv);
        Note.listener = e=>textSaver(Note);
        !lists[list]? lists[list] = []:0;
        mustPushed && note===''? lists[list].unshift(noteArea): mustPushed? lists[list].push(noteArea):0;
        updateLocalStorage();
        if(list === activeList){
          isPinned ? pinned.append(noteArea) : note==='' ?nonPinned.prepend(noteArea):nonPinned.append(noteArea)
        }
        note==='' ? editFunc(Note) : 0;
        note!=='' ? resizeFunc(Note, Note.size):0;

        footerPosition();
      };
      if(fullNotes){
        for(i=0; i < gotNotes.length; i++){
          noteAdder(null, Object.values(fullNotes)[i][0], Object.values(fullNotes)[i][1], Object.values(fullNotes)[i][2], Object.values(fullNotes)[i][3], Object.values(fullNotes)[i][4], true)
        }
      }

      footerPosition();
      ANBtn.addEventListener("click", e=>noteAdder(e, '', false, 1, '', activeList, true));
      document.head.lastElementChild.setAttribute('href', window.matchMedia('(prefers-color-scheme: dark)').matches?'My Notes/Pictures/Light Theme/HeaderFile.png':'My Notes/Pictures/Dark Theme/HeaderFile.png');
    </script>
  </body>
</html>
