function formatText(tag) {
        var textarea = document.getElementById("txtarea-input");
        var text = textarea.value;
        var selectedText = text.substring(textarea.selectionStart, textarea.selectionEnd);
        var newText = "";
        switch (tag) {
            case 'bold':
                newText = text.slice(0, textarea.selectionStart) + "<b>" + selectedText + "</b>" + text.slice(textarea.selectionEnd);
                break;
            case 'italic':
                newText = text.slice(0, textarea.selectionStart) + "<i>" + selectedText + "</i>" + text.slice(textarea.selectionEnd);
                break;
            case 'underline':
                newText = text.slice(0, textarea.selectionStart) + "<u>" + selectedText + "</u>" + text.slice(textarea.selectionEnd);
                break;
            case 'h1':
                newText = text.slice(0, textarea.selectionStart) + "<h1>" + selectedText + "</h1>" + text.slice(textarea.selectionEnd);
                break;
            case 'h2':
                newText = text.slice(0, textarea.selectionStart) + "<h2>" + selectedText + "</h2>" + text.slice(textarea.selectionEnd);
                break;
            case 'h3':
                newText = text.slice(0, textarea.selectionStart) + "<h3>" + selectedText + "</h3>" + text.slice(textarea.selectionEnd);
                break;
            case 'list':
                var lines = selectedText.split('\n');
                var listText = '';
                for (var i = 0; i < lines.length; i++) {
                    listText += "<li class=\"lista-blog\">" + lines[i] + "</li>";
                }
                newText = text.slice(0, textarea.selectionStart) + "<ul>" + listText + "</ul>" + text.slice(textarea.selectionEnd);
                break;
	    case 'link':
    		var linkURL = prompt("Unesite URL za hipervezu:");
    		if (linkURL) {
        	newText = text.slice(0, textarea.selectionStart) + '<a href="' + linkURL + '" rel="follow/nofollow">' + selectedText + '</a>' + text.slice(textarea.selectionEnd);
    		}
    		break;

            case 'dodatna_slika':
                var name = prompt("Unesite naslov slike:");
                var alt = prompt("Unesite alt slike");
                var img = "";
                newText = text.slice(0, textarea.selectionStart) + '<img class="img-fluid col-12 col-sm-12" src="../admin.excelum.hr/blog/UpisiImeFilea' + img + '" alt="' + alt +'" name="' + name +'">' + selectedText + text.slice(textarea.selectionEnd);
                break;
            // Add more cases for other formatting options
            default:
                break;
        }
        textarea.value = newText;
    }

    function editText(tag) {
        var textarea = document.getElementById("txtarea-input1");
        var text = textarea.value;
        var selectedText = text.substring(textarea.selectionStart, textarea.selectionEnd);
        var newText = "";
        switch (tag) {
            case 'bold':
                newText = text.slice(0, textarea.selectionStart) + "<b>" + selectedText + "</b>" + text.slice(textarea.selectionEnd);
                break;
            case 'italic':
                newText = text.slice(0, textarea.selectionStart) + "<i>" + selectedText + "</i>" + text.slice(textarea.selectionEnd);
                break;
            case 'underline':
                newText = text.slice(0, textarea.selectionStart) + "<u>" + selectedText + "</u>" + text.slice(textarea.selectionEnd);
                break;
            case 'h1':
                newText = text.slice(0, textarea.selectionStart) + "<h1>" + selectedText + "</h1>" + text.slice(textarea.selectionEnd);
                break;
            case 'h2':
                newText = text.slice(0, textarea.selectionStart) + "<h2>" + selectedText + "</h2>" + text.slice(textarea.selectionEnd);
                break;
            case 'h3':
                newText = text.slice(0, textarea.selectionStart) + "<h3>" + selectedText + "</h3>" + text.slice(textarea.selectionEnd);
                break;
            case 'list':
                var lines = selectedText.split('\n');
                var listText = '';
                for (var i = 0; i < lines.length; i++) {
                    listText += "<li class=\"lista-blog\">" + lines[i] + "</li>";
                }
                newText = text.slice(0, textarea.selectionStart) + "<ul>" + listText + "</ul>" + text.slice(textarea.selectionEnd);
                break;
	    case 'link':
    		var linkURL = prompt("Unesite URL za hipervezu:");
    		if (linkURL) {
        	newText = text.slice(0, textarea.selectionStart) + '<a href="' + linkURL + '" rel="follow/nofollow">' + selectedText + '</a>' + text.slice(textarea.selectionEnd);
    		}
    		break;

        case 'dodatna_slika':
            var name = prompt("Unesite naslov slike:");
            var alt = prompt("Unesite alt slike");
            var img = "";
            newText = text.slice(0, textarea.selectionStart) + '<img class="img-fluid col-12 col-sm-12" src="../admin.excelum.hr/blog/UpisiImeFilea' + img + '" alt="' + alt +'" name="' + name +'">' + selectedText + text.slice(textarea.selectionEnd);
            break;
        // Add more cases for other formatting options
        default:
            break;
        }
        textarea.value = newText;
    }

    const ul = document.querySelector(".lista"),
    input = document.querySelector(".tagovi"),
    tagNumb = 100/*document.querySelector(".details span");*/
    let maxTags = 100,
    tags = [];
    countTags();
    createTag();
    function countTags(){
        input.focus();
        tagNumb.innerText = maxTags - tags.length;
    }
    function createTag(){
        ul.querySelectorAll("li").forEach(li => li.remove());
        tags.slice().reverse().forEach(tag =>{
            let liTag = `<li>${tag} <i class="uit uit-multiply" onclick="remove(this, '${tag}')"></i></li>`;
            ul.insertAdjacentHTML("afterbegin", liTag);
        });
        countTags();
    }
    function remove(element, tag){
        let index  = tags.indexOf(tag);
        tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
        element.parentElement.remove();
        countTags();
    }
    function addTag(e){
        if(e.key == "Enter"){
            let tag = e.target.value.replace(/\s+/g, ' '); //mice space
            if(tag.length > 1 && !tags.includes(tag)){
                if(tags.length < maxTags){
                    tag.split(',').forEach(tag => {
                        tags.push(tag);
                        createTag();
                    });
                }
            }
            e.target.value = "";
        }
    }
    input.addEventListener("keyup", addTag);
    const removeBtn = document.querySelector(".details button");
    removeBtn.addEventListener("click", () =>{
        tags.length = 0;
        ul.querySelectorAll("li").forEach(li => li.remove());
        countTags();
    });
	
	// Jebo ti bog mater
	
	
	const ull = document.querySelector(".listaa"),
    inputt = document.querySelector(".tagovii"),
    tagNumbb = 100//document.querySelector(".details span");
    let maxtagsss = 100,
    tagss = [];
    counttagss();
    createTags();
    function counttagss(){
        inputt.focus();
        tagNumbb.innerText = maxtagsss - tagss.length;
    }
    function createTags(){
        ull.querySelectorAll("li").forEach(li => li.remove());
        tagss.slice().reverse().forEach(tag =>{
            let liTagg = `<li>${tag} <i class="uit uit-multiply" onclick="remove(this, '${tag}')"></i></li>`;
            ull.insertAdjacentHTML("afterbegin", liTagg);
        });
        counttagss();
    }
    function remove(element, tag){
        let indexx  = tagss.indexOf(tag);
        tagss = [...tagss.slice(0, indexx), ...tagss.slice(indexx + 1)];
        element.parentElement.remove();
        counttagss();
    }
    function addTags(e){
        if(e.key == "Enter"){
            let tags = e.target.value.replace(/\s+/g, ' '); //mice space
            if(tags.length > 1 && !tagss.includes(tags)){
                if(tagss.length < maxtagsss){
                    tags.split(',').forEach(tags => {
                        tagss.push(tags);
                        createTags();
                    });
                }
            }
            e.target.value = "";
        }
    }
    inputt.addEventListener("keyup", addTags);
    const removeBtns = document.querySelector(".details button");
    removeBtn.addEventListener("click", () =>{
        tagss.length = 0;
        ull.querySelectorAll("li").forEach(li => li.remove());
        counttagss();
    });
	
document.addEventListener("DOMContentLoaded", function() {
  var textarea = document.getElementById("txtarea-input");

  textarea.addEventListener("keydown", function(event) {
    if (event.key === "Enter" && event.target === textarea) {
      event.preventDefault();
      var cursorPosition = textarea.selectionStart;
      var textBeforeCursor = textarea.value.substring(0, cursorPosition);
      var textAfterCursor = textarea.value.substring(cursorPosition);
      textarea.value = textBeforeCursor + "<br>" + textAfterCursor;
      textarea.selectionStart = textarea.selectionEnd = cursorPosition + 4; // Set cursor position after "<br>"
    }
  });
});
	
