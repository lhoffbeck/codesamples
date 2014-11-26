/*
Bubble Sort
11-24-14
Lars Hoffbeck

Just going through the sorting algorithms for practice...

*/

class Utils{

    // get a random list with specified length and maximum random value
    static def List getRandomList(length, max){
        def rand = new Random(), arr = []
        for(i in 1..length) arr.add(rand.nextInt(max))
        return arr
    } 
    
    static def void swap(list, item1, item2){ Collections.swap(list, item1, item2) }
}

class BubbleSort{

    // perform a bubble sort. Items will be in low-high order.
    def sort(list){
    
        // iterate down to next to last item
        for(backIndex in list.size()-1..1){
            for(index in 0..backIndex-1)
               if(list[index] > list[index+1]) Utils.swap(list, index, index+1)
        }
        return list
    }
    
    
    // perform a reversed bubble sort. Items will still be in low-high order,
    //  but it goes through the array backwards.
    def sortReversed(list){
        
        // iterate up to next to last item
        for(backIndex in 0..list.size()-2){
            for(index in backIndex+1..1)
               if(list[index] < list[index-1]) Utils.swap(list, index, index-1)
        }
        return list
    }
    
    
    // perform a bubble sort using a while loop and a nested for loop.
    def sortWithWhile(list){
    
        def valueChanged = true
        def backIndex = list.size() - 1
        
        while(valueChanged){
        
            valueChanged = false // set to false, change if there's a swap
            for(int index = 0; index < backIndex; index++){
                if(list[index] > list[index+1]){
                    Utils.swap(list, index, index+1)
                    valueChanged = true
                }
            }
            backIndex--
        }
        return list
    }
    
    def runner(sorter, list){
         
        def startTime = System.nanoTime()
        
        // invoke method where sorter variable is the closure name
        def sortedList = "$sorter"(list.clone()) //send value instead of reference
        //println sortedList
        println "total time - $sorter: ${System.nanoTime() - startTime}"    
    }
}

// ################################ BEGIN RUN SECTION ################################
def bs = new BubbleSort()
def list = Utils.getRandomList(100, 1000) // (list length, max. random value)
def sorts = ["sort","sortReversed","sortWithWhile"]

sorts.each{ sort -> bs.runner(sort, list)}
// ################################ END RUN SECTION ################################