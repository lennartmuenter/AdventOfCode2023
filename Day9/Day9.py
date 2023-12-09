import numpy as np

def getPrediction(line, part1):
    line = np.array(line.split(),dtype=int)
    
    differences = []
    index = 0
    lasts = []

    while set(differences) != {0}:
        differences = np.diff(line, index)
        lasts.insert(0, differences[-1]) if part1 else lasts.insert(0, differences[0])
        index += 1
        
    prediction = 0
        
    for n in lasts:
        if part1:
            prediction = n + prediction 
        else:
            prediction = n - prediction
            
    return prediction
    
file = open('Day9.txt').read().split('\n')

for part1 in (True,False):
    print(sum(list(getPrediction(line, part1) for line in file)))