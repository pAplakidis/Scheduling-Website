const draggables = document.querySelectorAll('.draggable');
const empties = document.querySelectorAll('.empty');

let draggedItem = null;

//Items Listeners
for(let i = 0; i < draggables.length; i++){
    const item = draggables[i];

    item.addEventListener('dragstart', function(){
     draggedItem = item;
     setTimeout(function(){
            item.style.display = 'none';
        }, 0);  
    });

    item.addEventListener('dragend', function(){
        setTimeout(function(){
         draggedItem.style.display = 'block;'
         draggedItem = null;
        }, 0);
    });

    for(let j = 0; j < empties.length; j++){
        const empty = empties[j];

     empty.addEventListener('dragover', function(e){
         e.preventDefault();
      });

     empty.addEventListener('dragenter', function(e){
          e.preventDefault();
          this.style.backgroundColor = 'rgba(0, 0, 0, 0.2)';
        });

     empty.addEventListener('dragleave', function(){
        this.style.backgroundColor = 'rgba(0, 0, 0, 0.1)';
         });

     empty.addEventListener('drop', function(){
            this.append(draggedItem);
            this.style.backgroundColor = 'rgba(0, 0, 0, 0.1)';
         });
    }
}