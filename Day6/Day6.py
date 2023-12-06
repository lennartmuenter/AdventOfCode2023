file = open('Day6.txt', 'r')
lines = file.readlines()

races = []

for line in lines:
    line = line.split()
    race = []
    for value in line:
        if value.isnumeric():
            race.append(int(value))
    races.append(race)

def countWays(time, distance):
    ways = 0
    for x in range(time):
        val = x * (time - x)
        if val > int(distance):
            ways += 1
    return ways

def multiplyWays(races):
    numberOfWays = 1
    for index in range(len(races[0])):
        time = races[0][index]
        distance = races[1][index]
        numberOfWays *= countWays(time, distance)
    return numberOfWays

print(multiplyWays(races))

for index in range(len(races)):
    value = ''
    for number in races[index]:
        value += str(number)
    races[index] = int(value)

def findWays(races):
    time = races[0]
    distance = races[1]
    return countWays(time, distance)

print(findWays(races))