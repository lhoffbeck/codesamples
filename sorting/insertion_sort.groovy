/*

Insertion Sort
11-23-14
Lars Hoffbeck

Just going through the sorting algorithms for practice...

I wanted to see what the difference would be in using a temp variable or not during the swap,
and not using it is significantly faster with a 100 item list on my machine. Curiously, it
looks like it actually ends up being faster to use temp variable with larger lists (10,000 items):

run 1:
nt: 8964039000
t:  8107711000

nt: 9223052000
t:  7859921000

nt: 9197841000
t:  7715462000

*/


// ############################ BEGIN METHODS ############################

// get a random list with specified length and maximum random value
def List getRandomList(length, max){
    def rand = new Random()
    def arr = []
    
    for(i in 1..length) arr.add(rand.nextInt(max))
    
    return arr
}


// perform insertion sort using a temp variable
def sortWithTemp(list){

    for(index in 1..list.size()-1){
    
        def backIndex = index - 1
        def current =  list[index]
        
        // iterate back through the list swapping with smaller items    
        while( backIndex >= 0 && current < list[backIndex]){
            def temp = list[backIndex]
            list[backIndex] = current
            list[backIndex + 1] = temp
            
            backIndex--
        }
        
    }
    return list
}

def sortNoTemp(list){

    for(index in 1..list.size()-1){
    
        def backIndex = index
        def currentValue =  list[index]

        // iterate back through the list swapping with smaller items      
        while( backIndex > 0 && currentValue < list[backIndex - 1]){  
            list[backIndex] = list[backIndex-1]
            backIndex--
        }
        // only set the current item being operated on once
        list[backIndex] = currentValue
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


// ---------------------BEGIN run first test (sort without using a temp variable)
def startTime = System.nanoTime()
def sortedList = sortNoTemp(list.clone()) //send value instead of reference 
def endTime = System.nanoTime()
println endTime - startTime
println sortedList
// ---------------------END run first test

// ---------------------BEGIN run second test (sort using a temp variable)
startTime = System.nanoTime()
sortedList = sortWithTemp(list.clone())  // want to send value instead of reference
endTime = System.nanoTime()
println endTime - startTime
println sortedList
// ---------------------END run second test
// ################################ END RUN SECTION ################################