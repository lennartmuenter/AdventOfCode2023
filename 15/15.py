def makeHash(string):
    current = 0
    for char in string:
        current += ord(char)
        current *= 17
        current %= 256
    return current
        
file = open('15.txt').read().split(',')

sum = 0
boxes = [None] * 256

for string in file:
    sum += makeHash(string)
    current = {}
    tmp = string.split('=')
    if '-' in tmp[0]:
        current['operation'] = '-'
        tmp = tmp[0].replace('-', '')
        current['name'] = tmp
        current['box'] = makeHash(tmp)
    else:
        current['operation'] = '='
        current['name'] = tmp[0]
        current['box'] = makeHash(tmp[0])
        current['value'] = int(tmp[1])
    
    if boxes[current['box']] == None:
        boxes[current['box']] = {}
        
    if current['operation'] == '=':
        boxes[current['box']][current['name']] = current['value']
    elif current['operation'] == '-':
        boxes[current['box']].pop(current['name'], None)
    
print(sum)

sum = 0

for index in range(len(boxes)):
    if boxes[index] is not None:
        slots = list(boxes[index])
        for name in boxes[index]:
            sum += (index + 1) * (slots.index(name) + 1) * boxes[index][name]
            
print(sum)