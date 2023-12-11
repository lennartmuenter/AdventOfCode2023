file = open('11.txt').read().split('\n')

def findEmpty(arr):
    y = []
    x = []
    for row in range(len(arr)):
        if set(arr[row]) == {'.'}: x.append(row)
    for col in range(len(arr[0])):
        tmp = []
        for row in range(len(arr)):
            tmp.append(arr[row][col])
        if set(tmp) == {'.'}: y.append(col)
            
    return [x,y]

def findPoints(arr):
    points = [] # 0: x, 1: y
    for y in range(len(arr)):
        for x in range(len(arr[0])):
            if arr[y][x] != '.':
                points.append([x,y])
    return points

def movePoints(empty, points, multiplyer):
    currentPoint = []
    for index in range(len(points)):
        currentPoint = [*points[index]]
        for emptyRow in empty[0]:
            if emptyRow > currentPoint[1]:
                break
            points[index][1] += multiplyer
        for emptyCol in empty[1]:
            if emptyCol > currentPoint[0]:
                break
            points[index][0] += multiplyer
    return points

def getDistancesSum(points):
    sum = 0
    for index in range(len(points)):
        for next in range(index + 1, len(points)):
            sum += abs(points[index][0] - points[next][0])+abs(points[index][1] - points[next][1])
    return sum
        
for i in (1,999999):
    empty = findEmpty(file) 
    points = movePoints(empty, findPoints(file), i)
    sum = getDistancesSum(points)

    print(sum)