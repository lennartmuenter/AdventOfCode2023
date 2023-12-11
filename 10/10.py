arr = list(map(list, open('10.txt').read().split('\n')))

containsStart = [line for line in arr if 'S' in line][0]

position = {'x': containsStart.index('S'),'y': arr.index(containsStart) - 1}
lastMove = [0, -1] # x, y

polygon = []

count = 1

while arr[position['y']][position['x']] != 'S':
    polygon.append([position['x'], position['y']])
    current = arr[position['y']][position['x']]
    if current == '|':
        if lastMove == [0, 1]:
            position['y'] += 1
            lastMove = [0, 1]
        elif lastMove == [0, -1]:
            position['y'] -= 1
            lastMove = [0, -1]
            
    elif current == '-':
        if lastMove == [1,0]:
            position['x'] += 1
            lastMove = [1, 0]
        elif lastMove == [-1,0]:
            position['x'] -= 1
            lastMove = [-1,0]
            
    elif current == '7':
        if lastMove == [1,0]:
            position['y'] += 1
            lastMove = [0,1]
        elif lastMove == [0, -1]:
            position['x'] -= 1
            lastMove = [-1,0]
            
    elif current == 'J':
        if lastMove == [1,0]:
            position['y'] -= 1
            lastMove = [0, -1]
        elif lastMove == [0, 1]:
            position['x'] -= 1
            lastMove = [-1,0]
            
    elif current == 'L':
        if lastMove == [-1,0]:
            position['y'] -= 1
            lastMove = [0, -1]
        elif lastMove == [0, 1]:
            position['x'] += 1
            lastMove = [1, 0]
            
    elif current == 'F':
        if lastMove == [-1,0]:
            position['y'] += 1
            lastMove = [0,1]
        elif lastMove == [0,-1]:
            position['x'] += 1
            lastMove = [1,0]
                                    
    count += 1
            
print(int(count/ 2))

sum = 0
for n in range(len(polygon)):
    n1 = n+1
    if n1 == len(polygon): n1 = 0
    sum += polygon[n][0] * polygon[n1][1] - polygon[n1][0] * polygon[n][1]

a = abs(sum) / 2

i = a + 1 - (len(polygon) / 2)
            
print(int(i))