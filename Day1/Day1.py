import re

def findNumber(line):
    line = re.sub('\\D', '', line)
    numbers = list(line)
    return int(numbers[0] + numbers[len(numbers) - 1])

file = open('Day1.txt', 'r')

countFirst = 0
countSecond = 0

for line in file.readlines():
    line = line.strip()

    abc = {
        1 : 'one',
        2 : 'two',
        3 : 'three',
        4 : 'four',
        5 : 'five',
        6 : 'six',
        7 : 'seven',
        8 : 'eight',
        9 : 'nine',
    }

    countFirst += findNumber(line)

    for key, val in abc.items():
        line = re.sub(val, val+str(key)+val, line)
    countSecond += findNumber(line)

print(countFirst)
print(countSecond)