const draggables = document.querySelectorAll('.draggable');
const empties = document.querySelectorAll('.empty');

let draggedDraggable = null;

//Items Listeners
for(let i = 0; i < draggables.length; i++){
    const draggable = draggables[i];

    item.addEventListener('dragstart', function(){
     draggedDraggable = item;
     setTimeout(function(){
            item.style.display = 'none';
        }, 0);  
    });

    item.addEventListener('dragend', function(){
        setTimeout(function(){
         draggedDraggable.style.display = 'block;'
         draggedDraggable = null;
        }, 0);
    });

    for(let j = 0; j < empties.length; j++){
        const empty = empties[j];

     empty.addEventListener('dragover', function(e){
         e.preventDefault();
      });

     empty.addEventListener('dragenter', function(e){
          e.preventDefault();
        });

     empty.addEventListener('dragleave', function(){

         });

     empty.addEventListener('drop', function(){
            console.log('drop');
            this.append(draggedDraggable);
         });
    }
}

