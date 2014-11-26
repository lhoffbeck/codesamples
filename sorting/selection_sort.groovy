/*
Selection Sort
11-24-14
Lars Hoffbeck

Just going through the sorting algorithms for practice...

*/


// ############################ BEGIN METHODS ############################
// get a random list with specified length and maximum random value

def List getRandomList(length, max){

    def rand = new Random()
    def arr = []
    for(i in 1..length) arr.add(rand.nextInt(max))
    
    return arr
}

def List sortReversed(list){

    for(index in list.size()-1..1){
        
        def maxIndex = index

        for(searchIndex in (index - 1)..1){
            if(list[searchIndex] > list[maxIndex]) maxIndex = searchIndex
        }
        
        if(index != maxIndex){
            def temp = list[index]
            list[index] = list[maxIndex]
            list[maxIndex] = temp
        }
    }
    return list
}

def List sort(list){

    // size less 2, last item will already be in order because of swapping
    for(index in 0..list.size()-2){
        
        def minIndex = index

        for(searchIndex in (index + 1)..list.size()-1){
            if(list[searchIndex] < list[minIndex]) minIndex = searchIndex
        }
        
        if(index != minIndex){
            def temp = list[index]
            list[index] = list[minIndex]
            list[minIndex] = temp
        }
    }
    return list
}
// ############################ END METHODS ############################


// ################################ BEGIN RUN SECTION ################################
// ---------------------BEGIN setup
def listSize = 10
def maxRandValue = 10000
def list = getRandomList(listSize, maxRandValue)
// ---------------------END setup


// ---------------------BEGIN run first test (regular selection sort)
def startTime = System.nanoTime()
def sortedList = sort(list.clone()) //send value instead of reference
def endTime = System.nanoTime()
println endTime - startTime
println sortedList
// ---------------------END run first test

// ---------------------BEGIN run second test (reversed selection sortr)
startTime = System.nanoTime()
sortedList = sortReversed(list.clone()) // want to send value instead of reference
endTime = System.nanoTime()
println endTime - startTime
println sortedList
// ---------------------END run second test
// ################################ END RUN SECTION ################################