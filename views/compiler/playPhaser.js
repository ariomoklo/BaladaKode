var game = new Phaser.Game(860, 480, Phaser.AUTO, 'playPhaser', playState, true);
var redWait = false;
var blueWait = false;
var playing = false;
var waiting = true;

var redBot, blueBot, redHud, blueHud;
var posX, posY;
var board;

var redPoint = 0;
var bluePoint = 0;

function onComplete(bot){
    if(bot == 'red'){
        redBot.animations.currentAnim.onComplete.add(redComplete, this);
    }else if(bot == 'blue'){
        blueBot.animations.currentAnim.onComplete.add(blueComplete, this);
    }
}

var redComplete = function(sprite, animation){ 
    waiting = false;
    redWait = false;
    
//    if(animation.name == 'moveBack'){
//        //redBot.x -= posX;
//    }else if(animation.name == 'moveFront'){
//        //redBot.x += posX;
//        //redBot.y += 15;
//        console.log(redBot.x + ' | ' + redBot.y);
//    }
}
var blueComplete = function(sprite, animation){
    waiting = false;
    blueWait = false;
    
    if(animation.name == 'moveBack'){
        blueBot.x = posX*4;
    }
}

function punch(side, bot){
    if(!redWait && bot == 'red'){
        if(side == 'left'){
            redBot.animations.play('leftPunch');
        }else if(side == 'right'){
            redBot.animations.play('rightPunch');
        }
        redWait = true;
        onComplete('red');
    }

    if(!blueWait && bot == 'blue'){
        blueBot.x = posX*3;
        if(side == 'left'){
            blueBot.animations.play('leftPunch');
        }else if(side == 'right'){
            blueBot.animations.play('rightPunch');
        }
        blueWait = true;
        onComplete('blue');
    }
}

function kick(side, bot){
    if(!blueWait && bot == 'blue'){
        blueBot.x = posX*3;
        if(side == 'left'){
            blueBot.animations.play('leftKick');
        }else if(side == 'right'){
            blueBot.animations.play('rightKick');
        }
        blueWait = true;
        onComplete('blue');
    }
    
    if(!redWait && bot == 'red'){
        if(side == 'left'){
            redBot.animations.play('leftKick');
        }else if(side == 'right'){
            redBot.animations.play('rightKick');
        }
        redWait = true;
        onComplete('red');
    }
}

function block(bot){
    if(!redWait && bot == 'red'){
        redBot.animations.play('block');
        redWait = true;
        onComplete('red');
    }
    
    if(!blueWait && bot == 'blue'){
        blueBot.x = posX*3;
        blueBot.animations.play('block');
        blueWait = true;
        onComplete('blue');
    }
}

function evade(bot){
    if(!blueWait && bot == 'blue'){
        blueBot.x = posX*3;
        blueBot.animations.play('moveBack');
        
        blueWait = true;
        onComplete('blue');
    }
    
    if(!redWait && bot == 'red'){
        redBot.animations.play('moveBack');
        
        redWait = true;
        onComplete('red');
    }
}

function hit(bot){
    if(!redWait && bot == 'red'){
        redBot.animations.play('hit');
        redWait = true;
        onComplete('red');
    }
    
    if(!blueWait && bot == 'blue'){
        blueBot.x = posX*3;
        blueBot.animations.play('hit');
        blueWait = true;
        onComplete('blue');
    }
}

function win(bot){
    if(!redWait && bot == 'red'){
        redBot.animations.play('win');
        redWait = true;
        onComplete('red');
    }
    
    if(!blueWait && bot == 'blue'){
        blueBot.x = posX*3;
        blueBot.animations.play('win');
        blueWait = true;
        onComplete('blue');
    }
}

function lose(bot){
    if(!redWait && bot == 'red'){
        redBot.animations.play('lose');
        redWait = true;
        onComplete('red');
    }
    
    if(!blueWait && bot == 'blue'){
        blueBot.x = posX*3;
        blueBot.animations.play('lose');
        blueWait = true;
        onComplete('blue');
    }
}

function playerMove(bot, seq){
    console.log(bot+' Move');
    if(seq.key == 'punch'){
        punch(seq.side, bot);
        console.log('punch');
    }else if(seq.key == 'kick'){
        kick(seq.side, bot);
        console.log('kick');
    }else if(seq.key == 'evade'){
        console.log(redBot.x + ' | ' + redBot.y);
        evade(bot);
        console.log('move');
    }else if(seq.key == 'block'){
        block(bot);
        console.log('block');
    }else if(seq.key == 'hit'){
        hit(bot);
        console.log('hit');
    }else if(seq.key == 'win'){
        win(bot);
        console.log('block');
    }else if(seq.key == 'lose'){
        lose(bot);
        console.log('block');
    }
}

function checkMove(pl, en){                
    //jarak = pl.pos - en.pos;
    //if(Math.abs(jarak) == 1){
        if(pl.key == 'punch'){
            if(en.key == 'kick'){
                return false;
            }else if(en.key == 'block'){
                return false;
            }else if(en.key == 'jump'){
                return true;
            }else if(en.key == 'evade'){
                return false;
            }else if(en.key == 'none'){
                return true;
            }else if(en.key == 'punch'){
                return false;
            }
        }

        if(pl.key == 'kick' && pl.value == 0){
            if(en.key == 'kick'){
                return false;
            }else if(en.key == 'block'){
                return true;
            }else if(en.key == 'jump'){
                return true;
            }else if(en.key == 'evade'){
                return false;
            }else if(en.key == 'none'){
                return true;
            }else if(en.key == 'punch'){
                return true;
            }
        }

        if(pl.key == 'kick' && pl.value == 1){
            if(en.key == 'kick'){
                if(en.value == 0){
                    return true;
                }else{
                    return false;
                }
            }else if(en.key == 'block'){
                return true;
            }else if(en.key == 'jump'){
                return true;
            }else if(en.key == 'evade'){
                return false;
            }else if(en.key == 'none'){
                return true;
            }else if(en.key == 'punch'){
                return true;
            }
            
        }
    //}
}

var playState = {
    preload: function(){
        game.load.atlasJSONHash('hud', imgLoc+'compiler/img/hud.png', imgLoc+'compiler/img/hud.json');
        game.load.atlasJSONHash('redBot', imgLoc+'compiler/img/red-bot.png', imgLoc+'compiler/img/red-bot.json');
        game.load.atlasJSONHash('blueBot', imgLoc+'compiler/img/blue-bot.png', imgLoc+'compiler/img/blue-bot.json');
    },
    create: function(){
        posX = 170;
        posY = this.game.world.height;
                
        //this.background = game.add.image(this.game.world.centerX, this.game.world.centerY, 'hud', 'Background-Stage.png');
        redHud = game.add.image(0, 0, 'hud', 'red-0');
        blueHud = game.add.image(this.game.world.width, 0, 'hud', 'blue-0');
        
        var redStyle = {
            font: "18px Arial",
            fill: "#333",
            wordWrap: true,
            wordWrapWidth: redHud.width/2,
            align: "center"
        };
        this.redPlate = game.add.text(0, redHud.width/2, redUser+"\n"+redName, redStyle);
        
        var blueStyle = {
            font: "18px Arial",
            fill: "#333",
            wordWrap: true,
            wordWrapWidth: blueHud.width/2,
            align: "center"
        };
        this.bluePlate = game.add.text(0, blueHud.width/2, blueUser+"\n"+blueName, blueStyle);
        
        redBot = game.add.sprite(posX*2, posY, 'redBot', 'Idle_000');
        blueBot = game.add.sprite(posX*3, posY, 'blueBot', 'Idle/blue_Blue_Idle_000');
        
        board = game.add.image(this.game.world.centerX, this.game.world.centerY, 'hud', 'fight-sign');
        
        //this.background.anchor.setTo(0.5);
        blueHud.anchor.setTo(1, 0);
        redBot.anchor.setTo(0.5, 1);
        blueBot.anchor.setTo(0.5, 1);
        board.anchor.setTo(0.5);
        
        redBot.scale.setTo(0.85);
        blueBot.scale.setTo(-0.85, 0.85);
        
        board.visible = false;
                
//        redHud.frameName = 'red-2';
//        blueHud.frameName = 'blue-3';
        
        blueBot.animations.add('idle', Phaser.Animation.generateFrameNames('Idle/blue_Blue_Idle_', 0, 9, '', 3), 10, true, false);
        blueBot.animations.add('leftKick', Phaser.Animation.generateFrameNames('LeftKick/blue_Blue_LeftKick_', 0, 9, '', 3), 10, false, false);
        blueBot.animations.add('leftPunch', Phaser.Animation.generateFrameNames('LeftPunch/blue_Blue_LeftPunch_', 0, 9, '', 3), 10, false, false);
        blueBot.animations.add('rightKick', Phaser.Animation.generateFrameNames('RightKick/blue_Blue_RightKick_', 0, 9, '', 3), 10, false, false);
        blueBot.animations.add('rightPunch', Phaser.Animation.generateFrameNames('RightPunch/blue_Blue_RightPunch_', 0, 9, '', 3), 10, false, false);
        blueBot.animations.add('land', Phaser.Animation.generateFrameNames('Land/blue_Blue_Land_', 0, 9, '', 3), 10, false, false);
        blueBot.animations.add('block', Phaser.Animation.generateFrameNames('Block/blue_Blue_Block_', 0, 9, '', 3), 10, false, false);
        blueBot.animations.add('hit', Phaser.Animation.generateFrameNames('Hit/blue_Blue_Hit_', 0, 9, '', 3), 10, false, false);
        blueBot.animations.add('hitBig', Phaser.Animation.generateFrameNames('HitBig/blue_Blue_HitBig_', 0, 9, '', 3), 10, false, false);
        blueBot.animations.add('lose', Phaser.Animation.generateFrameNames('Lose/blue_Blue_Lose_', 0, 9, '', 3), 10, false, false);
        blueBot.animations.add('win', Phaser.Animation.generateFrameNames('Win/blue_Blue_Win_', 0, 9, '', 3), 10, false, false);
        blueBot.animations.add('moveBack', Phaser.Animation.generateFrameNames('MoveBack/blue_Blue_MoveBack_', 0, 9, '', 3), 10, false, false);
        blueBot.animations.add('moveFront', Phaser.Animation.generateFrameNames('MoveForward/blue_Blue_MoveForward_', 0, 9, '', 3), 10, false, false);
        blueBot.animations.play('idle');
        
        redBot.animations.add('idle', Phaser.Animation.generateFrameNames('Idle_', 0, 9, '', 3), 10, true, false);
        redBot.animations.add('leftKick', Phaser.Animation.generateFrameNames('LeftKick_', 0, 9, '', 3), 10, false, false);
        redBot.animations.add('leftPunch', Phaser.Animation.generateFrameNames('LeftPunch_', 0, 9, '', 3), 10, false, false);
        redBot.animations.add('rightKick', Phaser.Animation.generateFrameNames('RightKick_', 0, 9, '', 3), 10, false, false);
        redBot.animations.add('rightPunch', Phaser.Animation.generateFrameNames('RightPunch_', 0, 9, '', 3), 10, false, false);
        redBot.animations.add('land', Phaser.Animation.generateFrameNames('Land_', 0, 9, '', 3), 10, false, false);
        redBot.animations.add('block', Phaser.Animation.generateFrameNames('Block_', 0, 9, '', 3), 10, false, false);
        redBot.animations.add('hit', Phaser.Animation.generateFrameNames('Hit_', 0, 9, '', 3), 10, false, false);
        redBot.animations.add('hitBig', Phaser.Animation.generateFrameNames('HitBig_', 0, 9, '', 3), 10, false, false);
        redBot.animations.add('lose', Phaser.Animation.generateFrameNames('Lose_', 0, 9, '', 3), 10, false, false);
        redBot.animations.add('win', Phaser.Animation.generateFrameNames('Win_', 0, 9, '', 3), 10, false, false);
        redBot.animations.add('moveBack', Phaser.Animation.generateFrameNames('MoveBack_', 0, 9, '', 3), 10, false, false);
        redBot.animations.add('moveFront', Phaser.Animation.generateFrameNames('MoveForward_', 0, 9, '', 3), 10, false, false);
        redBot.animations.play('idle');
        
        this.index = 0;
    },
    update: function(){
        this.redPlate.x = Math.floor(redHud.x+35);
        this.redPlate.y = Math.floor(redHud.y+25);
        
        this.bluePlate.x = Math.floor(blueHud.x-130);
        this.bluePlate.y = Math.floor(blueHud.y+25);
        
        if(playing){
            
            if(board.y < 0){
                if(board.visible){
                    board.visible = false;
                    waiting = false;
                }
            }else{
                if(board.visible){
                    board.y -= 10;
                }else{
                    board.visible = true;
                    board.y -= 10;
                }
            }
            
            if(!waiting){
                console.log('masuk');
                if(redSeq.length >= blueSeq.length){
                    console.log('masuk1');
                    if(this.index < redSeq.length){
                        console.log('masuk2');
                        if(typeof blueSeq[this.index] != 'undefined'){
                            console.log(redSeq[this.index]);
                            console.log(blueSeq[this.index]);
                            
                            if(checkMove(redSeq[this.index], blueSeq[this.index])){
                                console.log('bintang untuk merah');
                                redPoint++; 
                                redHud.frameName = 'red-'+(redPoint);
                                playerMove('red', redSeq[this.index]);
                                playerMove('blue', {key: 'hit', value: 0, pos: 0});
                            }else if(checkMove(blueSeq[this.index], redSeq[this.index])){
                                console.log('bintang untuk biru');
                                bluePoint++;
                                blueHud.frameName = 'blue-'+(bluePoint);
                                playerMove('blue', blueSeq[this.index]);
                                playerMove('red', {key: 'hit', value: 0, pos: 0});
                            }else{
                                playerMove('red', redSeq[this.index]);
                                playerMove('blue', blueSeq[this.index]);
                            }
                            
                        }else{
                            console.log(redSeq[this.index]);
                            
                            if(checkMove(redSeq[this.index], {key: 'none', value: 0, pos: 0})){
                                console.log('bintang untuk merah');
                                redHud.frameName = 'red-'+(redPoint);
                                playerMove('red', redSeq[this.index]);
                                playerMove('blue', {key: 'hit', value: 0, pos: 0});
                            }
                        }
                        this.index++;
                    }else{
                        playing = false;
                        console.log('playing off');
                    } waiting = true;
                }else{
                    console.log('masuk5');
                    if(this.index < blueSeq.length){
                        console.log('masuk6');
                        if(typeof redSeq[this.index] != 'undefined'){
                            console.log(redSeq[this.index]);
                            console.log(blueSeq[this.index]);
                            
                            if(checkMove(redSeq[this.index], blueSeq[this.index])){
                                console.log('bintang untuk merah');
                                redPoint++;
                                redHud.frameName = 'red-'+(redPoint);
                                playerMove('red', redSeq[this.index]);
                                playerMove('blue', {key: 'hit', value: 0, pos: 0});
                            }else if(checkMove(blueSeq[this.index], redSeq[this.index])){
                                console.log('bintang untuk biru');
                                bluePoint++;
                                blueHud.frameName = 'blue-'+(bluePoint);
                                playerMove('blue', blueSeq[this.index]);
                                playerMove('red', {key: 'hit', value: 0, pos: 0});
                            }else{
                                playerMove('red', redSeq[this.index]);
                                playerMove('blue', blueSeq[this.index]);
                            }
                        }else{
                            console.log(blueSeq[this.index]);
                            playerMove('blue', blueSeq[this.index]);
                            
                            if(checkMove(blueSeq[this.index], {key: 'none', value: 0, pos: 0})){
                                console.log('bintang untuk biru');
                                bluePoint++;
                                blueHud.frameName = 'blue-'+(bluePoint);
                                playerMove('blue', blueSeq[this.index]);
                                playerMove('red', {key: 'hit', value: 0, pos: 0});
                            }
                        }
                        this.index++;
                    }else{
                        playing = false;
                        console.log('playing off');
                    } waiting = true;
                }
            }
        }else{
            if(redPoint == 3){
                board.y = this.game.world.centerY;
                board.frameName = 'red-sign';
                board.visible = true;
            }

            if(bluePoint == 3){
                board.y = this.game.world.centerY;
                board.frameName = 'blue-sign';
                board.visible = true;
            }
        }        
    }
};

game.state.add('playState', playState);
game.state.start('playState');