var scriptHandler = function(code, player) {
    this.script = code;
    this.bot = player;
    this.sequence = function () {
        seq = new Array();
        i = 0;
        
        Block = function (){
            seq[i] = {key: 'block', value: 0};
            i++;
        }

        Evade = function (){
            seq[i] = {key: 'evade', value: 0};
            i++;
        }

        leftPunch = function (){
            seq[i] = {key: 'punch', value: 0, side: 'left'};
            i++;
        }

        leftKick = function (){
            seq[i] = {key: 'kick', value: 0, side: 'left'};
            i++;
        }

        rightPunch = function (){
            seq[i] = {key: 'punch', value: 0, side: 'right'};
            i++;
        }

        rightKick = function (){
            seq[i] = {key: 'kick', value: 0, side: 'right'};
            i++;
        }

        Jump = function (){
            seq[i] = {key: 'jump', value: 0};
            i++;
        }

        JumpPunch = function (){
            seq[i] = {key: 'punch', value: 1};
            i++;
        }

        JumpKick = function (){
            seq[i] = {key: 'kick', value: 1};
            i++;
        }   

        running = Function(this.script);
        running();
        
        return seq;
    };
};