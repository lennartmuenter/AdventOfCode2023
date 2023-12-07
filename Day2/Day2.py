import re

file = open('Day2.txt', 'r')

countFirst = 0
countSecond = 0

for line in file:
    game = re.split(': |;',line.strip())
    values = {
        'id': 0,
        'red': 0,
        'green': 0,
        'blue': 0,
    }
    for round in game:
        if 'Game' in round:
            values['id'] = int(re.sub('\\D', '', round))
            continue
        round = re.split(',', round)
        for color in round:
            val = int(re.sub('\\D', '', color))
            col = re.sub('\\d', '', color).strip()
            if val > values[col]: values[col] = val

    if values['red'] <= 12 and values['green'] <= 13 and values['blue'] <= 14:
        countFirst += values['id']
    
    countSecond += values['red'] * values['green'] * values['blue']
    

print(countFirst)
print(countSecond)

# Output 1: 2156
# Output 2: 66909