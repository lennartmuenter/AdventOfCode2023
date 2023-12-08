import re
from math import lcm

def countPathLength(steps, start, instructions):
    current = start
    instruction = 0
    count = 0
    while current[-1] != 'Z':
        if instruction == len(instructions): instruction = 0
        current = steps[current][instructions[instruction]]
        instruction += 1
        count += 1
    return count
    
file = open('Day8.txt').read().replace('\n\n', '\n').split('\n')

instructions = list(file.pop(0))

steps = {}
starter = []

for line in file:
    line = re.sub('\\W', ' ', line).split()
    steps[line[0]] = {
        'L': line[1],
        'R': line[2],
    }
    if line[0][-1] == 'A':
        starter.append(line[0])

print('Part1:', countPathLength(steps,'AAA',instructions))

pathLengths = []

for start in starter:
    pathLengths.append(countPathLength(steps, start, instructions))
    
print('Part2:', lcm(*pathLengths))