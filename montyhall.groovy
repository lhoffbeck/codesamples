class MontyHall{

    def _rand
    public MontyHall(){ _rand = new Random()}

    def ArrayList getRandomDoors(){
        def possibleCombos = [[1,0,0],[0,1,0],[0,0,1]]
        return possibleCombos[ _rand.nextInt(3)]
    }
    
    def int getRandZeroDoorIndex(doors, contestantChoice){
        def availableZeros = doors.findIndexValues{it == 0} - contestantChoice
        return availableZeros[ _rand.nextInt(availableZeros.size())]
    }
    
    def int runSimulation(changeChoice){
    
        def doors = getRandomDoors()
        def contestantChoice = _rand.nextInt(3)
        def zeroDoorIndex = getRandZeroDoorIndex(doors, contestantChoice)
        
        return changeChoice ? doors[3-contestantChoice-zeroDoorIndex] : doors[contestantChoice]
    }
}

numCorrect = 0
totalRuns = 10000000
changeChoice = false

r = new MontyHall()

for(i in 1..totalRuns){numCorrect += r.runSimulation(changeChoice)}


println ((numCorrect / totalRuns).toString())