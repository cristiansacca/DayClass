/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.cristian.dayclass;
import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Table;
import javax.persistence.Temporal;
/**
 *
 * @author Leandro
 */
@Entity
@Table(name="VigenciaSesion", schema="dayclass")
public class VigenciaSesion implements Serializable{
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    
    private int duracionSesion;

    public VigenciaSesion() {
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getDuracionSesion() {
        return duracionSesion;
    }

    public void setDuracionSesion(int duracionSesion) {
        this.duracionSesion = duracionSesion;
    }
    
    
}
